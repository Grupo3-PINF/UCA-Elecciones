
use App\User;

$user = new App\User();
$user->identificador="1";
$user->login='1';
$user->email="prueba34@uca.es";
$user->password=Hash::make('1');
$user->rolActivo='estudiante';
$user->save();