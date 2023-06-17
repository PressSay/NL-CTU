<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\Lexer\TokenEmulator\ExplicitOctalEmulator;

class ImageTmpResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $imagePath = explode('/', $this->path);
        $imagePath = "/storage/images/".$imagePath[count($imagePath) - 1];

        return [
            'path' => $imagePath,
        ];
    }
}
