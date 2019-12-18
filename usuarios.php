
use App\User;

$user = new App\User();
$user->identificador="34";
$user->login='u6';
$user->email="prueba34@uca.es";
$user->password=Hash::make('c6');
$user->rolActivo='estudiante';
$user->save();