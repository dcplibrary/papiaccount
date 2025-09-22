<?php

namespace Dcplibrary\PAPIAccount\App\Http\Controllers;

use Blashbrook\PAPIClient\PAPIClient;
use Dcplibrary\PAPIAccount\App\Livewire\Forms\PatronForm;
use Dcplibrary\PAPIAccount\App\Mail\Patron\RenewConfirmationMailable;
use Dcplibrary\PAPIAccount\App\Mail\Staff\RenewConfirmationStaffMailable;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use JsonException;

//@TODO: add mail function for when account is changed
class Patron extends Controller
{
    public PAPIClient $papiclient;
    public PatronForm $form;

    /**
     * @param $barcode
     * @param $password
     * @return mixed
     * @throws GuzzleException
     * @throws JsonException
     */
    public static function auth(PAPIClient $papiclient, $barcode, $password)
    {
        $json = [
            "Barcode" => $barcode,
            "Password" => $password,
        ];
        dd($json);
        $response = $this->papiclient
                    ->method('post')
                    ->uri('authenticator/patron')
                    ->params($json)
                    ->execRequest();
        return $response['AccessSecret'];
        dd($response);
    }

    /**
     * @param $barcode
     * @param $accessSecret
     * @return mixed
     * @throws GuzzleException
     * @throws JsonException
     */
    public static function open($barcode, $accessSecret)
    {
        $uri = 'patron/'.$barcode.'/basicdata?addresses=true&notes=true';
        $response = PAPIClient::authenticatedPatronRequest('GET', $uri, $accessSecret);
        $body = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);

        return $body['PatronBasicData'];
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public static function edit($key, $value): void
    {
        $json = [
            $key => $value,
        ];
        self::save($json);
    }

    /**
     * @param $json
     * @return mixed
     * @throws GuzzleException
     * @throws JsonException
     */
    public static function save($json)
    {
        $uri = 'patron/'.session('Barcode').'?ignoresa=true';
        $response = PAPIClient::authenticatedPatronRequest('PUT', $uri, session('AccessSecret'), $json);

        return json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param $photo
     * @return void
     */
    public static function savePhoto($photo)
    {
        $fileName = self::setFileName($photo);
        $photo->storeAs(path: 'photos', name: $fileName);
        $filePath = storage_path('app/private/photos/'.$fileName);
        Mail::to([session('EmailAddress')])
            ->bcc(env('PAPI_ADMIN_EMAIL', env('PAPI_ADMIN_NAME')))
            ->send(new RenewConfirmationMailable($filePath));
        Mail::to([env('PAPI_ADMIN_EMAIL')])
            ->send(new RenewConfirmationStaffMailable($filePath));
        session(['photoUploaded' => true]);
        redirect('dashboard/renew');
        File::delete($filePath);
    }

    /**
     * @param $file
     * @return string
     */
    private static function setFileName($file)
    {
        $fileExt = $file->getClientOriginalExtension();

        return sprintf(
            "%s_%s_%s.%s",
            session('NameLast'),
            session('NameFirst'),
            session('NameMiddle'),
            $fileExt
        );
    }

    /**
     * @return Application|RedirectResponse|Redirector|object
     */
    public static function logout()
    {
        session()->flush();

        return redirect("/");
    }
}
