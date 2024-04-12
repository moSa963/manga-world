<?php

namespace App\Http\Requests;

use App\Enums\SeriesStatus;
use App\Enums\SeriesTypes;
use App\Models\Series;
use App\Models\User;
use App\Rules\ImageFileRule;
use App\Services\StoragePathService;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSeriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }


    public function store(): Series
    {
        $series = Series::create([
            "user_id" => $this->user()->id,
            ...$this->validated(),
            "other_names" => implode(',', $this->validated("other_names", [])),
            "release_date" => new Carbon($this->validated("release_date")),
        ]);

        $this->file("poster")->storeAs(StoragePathService::forPoster($series));

        return $series;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $types = implode("|", SeriesTypes::values());
        $status = implode("|", SeriesStatus::values());

        return [
            "title" => ["required", "string", "unique:" . Series::class],
            "description" => ["required", "string"],
            "painter" => ["string"],
            "author" => ["string"],
            "other_names" => ["array"],
            "other_names.*" => ["string", "regex:/^[^,]*$/"],
            "type" => ["required", "regex:/{$types}/"],
            "status" => ["required", "regex:/{$status}/"],
            "release_date" => ["required", "date"],
            "poster" => ["file", "mimetypes:image/*"],
        ];
    }
}
