<?php

namespace App\Http\Controllers;

use File;
use Storage;

class ImageController extends Controller
{

	public static function getProfilePicture($image)
	{
		if (Storage::exists('public/' . $image)) {
			$type = File::mimeType(storage_path() . '/app/public/' . $image);

			return [
				'format' => $type,
				'picture' => base64_encode(Storage::get('public/' . $image))
			];
		}

		return false;
	}
}
