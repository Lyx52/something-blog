<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (!$this->has('id')) {
            return false;
        }
        $postId = $this->get("id");

        return Post::query()
            ->where('user_id', Auth::id())
            ->where('id', $postId)
            ->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:256',
            'body' => 'required|string',
            'id' => 'required|integer|exists:posts,id'
        ];
    }
}
