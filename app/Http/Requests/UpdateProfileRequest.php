<?php

namespace FrontFiles\Http\Requests;

use FrontFiles\User;
use FrontFiles\Utility\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'avatar'        => 'nullable|image:jpeg,jpg,png|max:1048576',
            'bio'           => 'nullable|string|max:500',
            'location'      => 'required|string|max:100',
            'lat'           => 'required|numeric',
            'lng'           => 'required|numeric',
            'role'          => 'required|in:user,corporative',
        ];
    }

    /**
     * Updates the user.
     *
     * @param User $user
     * @return mixed
     */
    public function persist(User $user)
    {
        $user->update([
            'first_name'    => request('first_name'),
            'last_name'     => request('last_name'),
            'bio'           => request('bio') ?? 'I am new here!',
            'location'      => request('location'),
            'latitude'      => request('lat'),
            'longitude'     => request('lng'),
        ]);

        if(request()->file('avatar'))
        {
            if($user->avatar_name)
                Helper::deleteUserAvatar($user->avatar_name);

            $rawCrop        = json_decode(request('crop'), true);
            $crop           = json_decode($rawCrop, true);
            $rawImg         = request()->file('avatar');
            $short_id       = Helper::generateRandomAlphaNumericString(12);
            $avatar_name    = $short_id . '.' . (string)$rawImg->clientExtension();

            $img = Image::make($rawImg)
                ->crop($crop['width'], $crop['height'], $crop['x'], $crop['y'])
                ->resize(null, 160, function ($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->stream();

            $avatarUrl = Helper::storeUserAvatarAndReturnUrl($avatar_name, $img->__toString());

            $user->update([
                'avatar'        => $avatarUrl ?? 'http://via.placeholder.com/300x300',
                'avatar_name'   => $avatar_name ?? null,
            ]);
        }

        $user->syncRoles([request('role')]);

        $user->generateSlug();

        $user->save();

        if(request()->expectsJson())
            return response([
                'status' => 'Profile successfully edited!',
                'slug' => $user->slug,
            ], 200);

        return redirect(route('profile'))
            ->with('message', 'Profile successfully edited!');
    }
}
