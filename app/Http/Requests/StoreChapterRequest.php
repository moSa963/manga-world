<?php

namespace App\Http\Requests;

use App\Models\Chapter;
use App\Models\Page;
use App\Models\Series;
use App\Services\StoragePathService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreChapterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return Auth::check();
    }

    public function store(Series $series): Chapter
    {
        abort_if($series->chapters()->where('number', $this->validated('number'))->exists(), 422, 'Number field must be unique');

        $chapter =  Chapter::create([
            "series_id" => $series->id,
            "user_id" => Auth::id(),
            "number" => $this->validated('number'),
            "title" => $this->validated('title'),
            "published" => false,
            "release_date" => $this->validated('release_date'),
        ]);

        $pages = $this->file('pages');

        for ($i = 0; $i < count($pages); ++$i) {

            $path = $pages[$i]->store(StoragePathService::forPage($chapter));
            $path = explode('/', $path);
            Page::create([
                "chapter_id" => $chapter->id,
                "name" => end($path),
                "number" => $i,
            ]);
        }

        return $chapter;
    }

    public function rules(): array
    {
        return [
            "number" => ['required', 'numeric'],
            "title" => ['required', 'string'],
            "release_date" => ['required', 'date'],
            'pages' => ['required', 'array'],
            'pages.*' => ['file', "mimetypes:image/*"]
        ];
    }
}
