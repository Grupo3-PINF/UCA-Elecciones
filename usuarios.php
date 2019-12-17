
use App\User;

$user = new App\User();
$user->identificador="33";
$user->login='m25';
$user->email="prueba33@uca.es";
$user->password=Hash::make('c25');
$user->rolActivo='estudiante';
$user->save();