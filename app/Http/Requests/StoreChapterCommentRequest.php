<?php

namespace App\Http\Requests;

use App\Models\Chapter;
use App\Models\ChapterComment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class StoreChapterCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function store(Chapter $chapter): ChapterComment
    {
        if (RateLimiter::tooManyAttempts($this->limiterKey($chapter), 1)) {
            $seconds = RateLimiter::availableIn($this->limiterKey($chapter));
            abort(429, 'You may try again in ' . $seconds . ' seconds.');
        }

        RateLimiter::hit($this->limiterKey($chapter), 300);

        return ChapterComment::create([
            "user_id" => Auth::id(),
            "chapter_id" => $chapter->id,
            "comment" => $this->validated("comment"),
        ]);
    }

    private function limiterKey(Chapter $chapter): string
    {
        return 'store comment:' . $chapter->id . Auth::user()->username;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "comment" => ['required', 'string'],
        ];
    }
}
