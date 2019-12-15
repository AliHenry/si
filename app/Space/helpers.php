<?php
use App\Space\Settings\Setting;
use Carbon\Carbon;
use Illuminate\Support\Str;
use jeremykenedy\LaravelRoles\Models\Role;
use App\Attendance;
use App\Customer;
use App\Billing;
use App\Employee;



function set_active($path, $active = 'active')
{
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function is_url($path)
{
    return call_user_func_array('Request::is', (array)$path);
}

function clean_slug($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return \Illuminate\Support\Str::lower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
}

function get_setting($key)
{
    return Setting::getSetting($key);
}

function getFullName($key)
{
    return $key->first_name.' '.$key->middle_name.' '.$key->last_name;
}

function uploadImage($request){
    $path = null;

    if ($request->has('avatar')){
        $file = $request->file('avatar');
        $destinationPath = 'employees';


        $path = $file->store($destinationPath, ['disk' => 'public']);

    }

    return $path;
}

function getNextEmployeeNumber()
{
    $interValNumber = 1;

    $numberOfStripOutLetter = 3;

    $codePrefix = 'EMP';

    $lastEmployee = Employee::orderBy('created_at', 'desc')->first();

    if ( ! $lastEmployee )

        $number = 0;
    else
        $number = substr($lastEmployee->code, $numberOfStripOutLetter);

    return $codePrefix. '' . sprintf('%04d', intval($number) + $interValNumber);
}

function getNextCustomerNumber()
{
    $interValNumber = 1;

    $numberOfStripOutLetter = 9;

    $codePrefix = 'BA/MJD01/';

    $lastCustomer = Customer::orderBy('created_at', 'desc')->first();

    if ( ! $lastCustomer )

        $number = 0;
    else
        $number = substr($lastCustomer->code, $numberOfStripOutLetter);

    return $codePrefix. '' . sprintf('%04d', intval($number) + $interValNumber);
}

function getNextBillingNumber()
{
    $interValNumber = 1;

    $numberOfStripOutLetter = 3;

    $codePrefix = 'BA/';

    $lastBill = Billing::orderBy('created_at', 'desc')->first();

    if ( ! $lastBill )

        $number = 0;
    else
        $number = substr($lastBill->code, $numberOfStripOutLetter);

    return $codePrefix. '' . sprintf('%09d', intval($number) + $interValNumber);
}

function getNextAttendanceNumber()
{
    $interValNumber = 1;

    $numberOfStripOutLetter = 3;

    $codePrefix = 'ATT';

    $lastAttendance = Attendance::orderBy('created_at', 'desc')->first();

    if ( ! $lastAttendance )

        $number = 0;
    else
        $number = substr($lastAttendance->code, $numberOfStripOutLetter);

    return $codePrefix. '' . sprintf('%09d', intval($number) + $interValNumber);
}

function totalBill($bill)
{
    return $bill->arrears + $bill->current_amount;
}


function slug_exist($name)
{
    $slug = $name;
    $num = null;

    do{
        $exist = Role::where('slug', $slug)->first();
        $slug = Str::slug($slug.' '.$num, '.');
        ++$num;
    }
    while ($exist);

    return $slug;
}

function attendanceCount($attend_id, $value){
    return \DB::table('attendance_employees')
        ->where('attend_id', $attend_id)
        ->where('type', '=', $value)->count();
}

function attendanceType($attend_id, $user_id){
    return \DB::table('attendance_employees')
        ->select('type')
        ->where('attend_id', $attend_id)
        ->where('emp_id', '=', $user_id)
        ->first();
}

function set_permission($name)
{
    $Permissionitems = [
        [
            'name'        => 'Can View '.$name,
            'slug'        => 'view.'.strtolower($name),
            'description' => 'Can view '.strtolower($name),
            'model'       => 'Permission',
            'type'        => strtolower($name)
        ],
        [
            'name'        => 'Can Create '.$name,
            'slug'        => 'create.'.strtolower($name),
            'description' => 'Can create new '.strtolower($name),
            'model'       => 'Permission',
            'type'        => strtolower($name)
        ],
        [
            'name'        => 'Can Edit '.$name,
            'slug'        => 'edit.'.strtolower($name),
            'description' => 'Can edit '.strtolower($name),
            'model'       => 'Permission',
            'type'        => strtolower($name)
        ],
        [
            'name'        => 'Can Delete '.$name,
            'slug'        => 'delete.'.strtolower($name),
            'description' => 'Can delete '.strtolower($name),
            'model'       => 'Permission',
            'type'        => strtolower($name)
        ],
    ];

    /*
     * Add Permission Items
     *
     */
    foreach ($Permissionitems as $Permissionitem) {
        $newPermissionitem = config('roles.models.permission')::where('slug', '=', $Permissionitem['slug'])->first();
        if ($newPermissionitem === null) {
            $newPermissionitem = config('roles.models.permission')::create([
                'name'          => $Permissionitem['name'],
                'slug'          => $Permissionitem['slug'],
                'description'   => $Permissionitem['description'],
                'model'         => $Permissionitem['model'],
                'type'          => $Permissionitem['type'],
            ]);
        }
    }

    return $newPermissionitem;

}
