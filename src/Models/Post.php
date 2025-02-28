<?php

namespace Firefly\FilamentBlog\Models;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Get;
use Filament\Forms\Set;
use FilamentTiptapEditor\TiptapEditor;
use Firefly\FilamentBlog\Database\Factories\PostFactory;
use Firefly\FilamentBlog\Enums\PostStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'sub_title',
        'body',
        'status',
        'published_at',
        'scheduled_for',
        'cover_photo_path',
        'photo_alt_text',
        'user_id',
    ];

    protected $dates = [
        'scheduled_for',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'published_at' => 'datetime',
        'scheduled_for' => 'datetime',
        'status' => PostStatus::class,
        'user_id' => 'integer',
    ];

    protected static function newFactory()
    {
        return new PostFactory();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, config('filamentblog.tables.prefix').'category_'.config('filamentblog.tables.prefix').'post');
    }

    public function comments(): hasmany
    {
        return $this->hasMany(Comment::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,config('filamentblog.tables.prefix').'post_'.config('filamentblog.tables.prefix').'tag');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('filamentblog.user.model'), config('filamentblog.user.foreign_key'));
    }

    public function seoDetail()
    {
        return $this->hasOne(SeoDetail::class);
    }

    public function isNotPublished()
    {
        return ! $this->isStatusPublished();
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('status', PostStatus::PUBLISHED)->latest('published_at');
    }

    public function scopeScheduled(Builder $query)
    {
        return $query->where('status', PostStatus::SCHEDULED)->latest('scheduled_for');
    }

    public function scopePending(Builder $query)
    {
        return $query->where('status', PostStatus::PENDING)->latest('created_at');
    }

    public function formattedPublishedDate()
    {
        return $this->published_at?->format(config('filamentblog.formatted_published_date'));
    }

    public function isScheduled()
    {
        return $this->status === PostStatus::SCHEDULED;
    }

    public function isStatusPublished()
    {
        return $this->status === PostStatus::PUBLISHED;
    }

    public function relatedPosts($take = 3)
    {
        return $this->whereHas('categories', function ($query) {
            $query->whereIn(config('filamentblog.tables.prefix').'categories.id', $this->categories->pluck('id'))
                ->whereNotIn(config('filamentblog.tables.prefix').'posts.id', [$this->id]);
        })->published()->with('user')->take($take)->get();
    }

    protected function getFeaturePhotoAttribute()
    {
        return asset('storage/'.$this->cover_photo_path);
    }

    public static function getForm()
    {
        return [
            Section::make(__('filament-blog::resources/posts.forms.sections.header_title'))
                ->schema([
                    Fieldset::make('Titles')
                        ->label(__('filament-blog::resources/posts.forms.sections.titles'))
                        ->schema([
                            Select::make('category_id')
                                ->label(__('filament-blog::resources/posts.forms.fields.category'))
                                ->multiple()
                                ->preload()
                                ->createOptionForm(Category::getForm())
                                ->searchable()
                                ->relationship('categories', 'name')
                                ->columnSpanFull(),

                            TextInput::make('title')
                                ->label(__('filament-blog::resources/posts.forms.fields.title'))
                                ->live(true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set(
                                    'slug',
                                    Str::slug($state)
                                ))
                                ->required()
                                ->unique(config('filamentblog.tables.prefix').'posts', 'title', null, 'id')
                                ->maxLength(255),

                            TextInput::make('slug')
                                ->label(__('filament-blog::resources/posts.forms.fields.slug'))
                                ->maxLength(255),

                            Textarea::make('sub_title')
                                ->label(__('filament-blog::resources/posts.forms.fields.sub_title'))
                                ->maxLength(255)
                                ->columnSpanFull(),

                            Select::make('tag_id')
                                ->label(__('filament-blog::resources/posts.forms.fields.tags'))
                                ->multiple()
                                ->preload()
                                ->createOptionForm(Tag::getForm())
                                ->searchable()
                                ->relationship('tags', 'name')
                                ->columnSpanFull(),
                        ]),
                    TiptapEditor::make('body')
                        ->label(__('filament-blog::resources/posts.forms.fields.body'))
                        ->profile('default')
                        ->disableFloatingMenus()
                        ->extraInputAttributes(['style' => 'max-height: 30rem; min-height: 24rem'])
                        ->required()
                        ->columnSpanFull(),
                    Fieldset::make('Feature Image')
                        ->label(__('filament-blog::resources/posts.forms.sections.feature_image'))
                        ->schema([
                            FileUpload::make('cover_photo_path')
                                ->label(__('filament-blog::resources/posts.forms.fields.cover_photo'))
                                ->directory('/blog-feature-images')
                                ->hint('This cover image is used in your blog post as a feature image. Recommended image size 1200 X 628')
                                ->image()
                                ->preserveFilenames()
                                ->imageEditor()
                                ->maxSize(1024 * 5)
                                ->rules('dimensions:max_width=1920,max_height=1080')
                                ->required(),
                            TextInput::make('photo_alt_text')
                                ->label(__('filament-blog::resources/posts.forms.fields.photo_alt_text'))
                                ->required(),
                        ])->columns(1),

                    Fieldset::make('Status')
                        ->label(__('filament-blog::resources/posts.forms.sections.status'))
                        ->schema([

                            ToggleButtons::make('status')
                                ->label(__('filament-blog::resources/posts.forms.fields.status.label'))
                                ->live()
                                ->inline()
                                ->options(PostStatus::class)
                                ->required(),

                            DateTimePicker::make('scheduled_for')
                                ->label(__('filament-blog::resources/posts.forms.fields.scheduled_for'))
                                ->visible(function ($get) {
                                    return $get('status') === PostStatus::SCHEDULED->value;
                                })
                                ->required(function ($get) {
                                    return $get('status') === PostStatus::SCHEDULED->value;
                                })
                                ->minDate(now()->addMinutes(5))
                                ->native(false),
                        ]),
                    Select::make(config('filamentblog.user.foreign_key'))
                        ->label(__('filament-blog::resources/posts.forms.fields.user'))
                        ->relationship('user', config('filamentblog.user.columns.name'))
                        ->nullable(false)
                        ->default(auth()->id()),

                ]),
        ];
    }

    public function getTable()
    {
        return config('filamentblog.tables.prefix') . 'posts';
    }
}
