<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CsvMapping\UploadCsvRequest;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use League\Csv\Reader;

class CsvMappingController extends BaseController
{
    public function index()
    {
        $users = User::all();
        return view('admin.csv_mapping.index', compact('users'));
    }

    public function csvUpload(UploadCsvRequest $request)
    {
        $validatedData = $request->validated();
        $csvFile = $request->file('csv_file');
        $userId = $validatedData['user_id'];

        $csvPath = $csvFile->storeAs('temp', $csvFile->getClientOriginalName());

        $csv = Reader::createFromPath(storage_path('app/' . $csvPath), 'r');
        $headers = $csv->fetchOne();
        Session::put('csv_headers', $headers);

        return Redirect::route('csv-mapping.map-csv', ['user_id' => $userId]);
    }

    public function mapCsv($user_id)
    {
        $csvHeaders = Session::get('csv_headers');

        $systemSettings = (new Setting())->getSettingsByParent('CSV_MAPPING');
        return view('admin.csv_mapping.map_csv', compact('csvHeaders', 'systemSettings', 'user_id'));
    }

    public function update(Request $request)
    {
        try {
            $parentSetting = (new Setting())->getSettingByKey('CSV_MAPPING');
            $user = User::find($request['user_id']);
            $data = [];
            foreach($request->map as $setting_key => $csv_value){
                $settingValue = $csv_value;

                // Find the setting by key
                $setting = Setting::where('key', $setting_key)->first();

                if ($setting) {
                    // Add the setting to the data array with the setting ID as the key
                    $data[$setting->id] = [
                        'value' => $settingValue,
                        'setting_parent_id' => $parentSetting->id,
                    ];
                }
            }

            $user->settings()->syncWithoutDetaching($data);

            return redirect()->route('user');
            // return $this->response('success', 'User settings updated successfully', [], 200);
        } catch (\Exception $e) {
            return $this->response('error', $e->getMessage(), [], 422);
        }
    }
}
