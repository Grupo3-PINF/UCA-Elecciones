
use App\User;

$user = new App\User();
$user->identificador="4";
$user->login='4';
$user->nombre="loko";
$user->apellido="laka";
$user->email="prueba324@uca.es";
$user->password=Hash::make('4');
$user->rolActivo='secretario';
$user->save();