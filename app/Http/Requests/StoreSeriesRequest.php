<?php

namespace App\Http\Requests;

use App\Enums\SeriesStatus;
use App\Enums\SeriesTypes;
use App\Models\Series;
use App\Models\User;
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
        return Series::create([
            "user_id" => $this->user()->id,
            ...$this->validated(),
            "release_date" => new Carbon($this->validated("release_date")),
        ]);
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
            "other_names" => ["string"],
            "type" => ["required", "regex:/{$types}/"],
            "status" => ["required", "regex:/{$status}/"],
            "release_date" => ["required", "date"],
        ];
    }
}
