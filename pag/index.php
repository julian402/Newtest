<?php

//Conexion a mysql
$connect = mysqli_connect('localhost', 'root', '', 'formulario');

// Recoge valores desde el formulario
$email = isset($_POST['email']) ?$_POST['email'] : '';
$message = isset($_POST['message']) ?$_POST['message'] : '';
$nombreCliente = isset($_POST['nombreCliente']) ?$_POST['nombreCliente'] : '';
$departamento = isset($_POST['departamento']) ?$_POST['departamento'] : '';
$empleadoSeleccionado = isset($_POST['NomEmpleadodep']) ?$_POST['NomEmpleadodep'] : '';


// Variables de gestion de error
$email_error = '';
$message_error = '';
$nombreCliente_error = '';
$departamento_error = '';
$empleadoSeleccionado = '';

if (count($_POST))
{
    $errors =  0;

    if ($_POST['email'] == '')
    {
        $email_error = 'Please enter an email address';
        $errors ++;
    }

    if ($_POST['message'] == '')
    {
        $message_error = 'Please enter a message';
        $errors ++;
    }

    if ($_POST['nombreCliente'] == '')
    {
        $nombreCliente_error = 'Please enter a name';
        $errors ++;
    }

    if ($_POST['departamento'] == '')
    {
        $departamento_error = 'Please enter a department';
        $errors ++;
    }

    


    if ($errors == 0)
    {
        $query = 'INSERT INTO  contact (
            email,
            message,
            nombreCliente,
            departamento,
            NomEmpleadodep
        )   VALUES (
            "'.addslashes($_POST['email']).'",
            "'.addslashes($_POST['message']).'",
            "'.addslashes($_POST['nombreCliente']).'",
            "'.addslashes($_POST['departamento']).'",
            "'.addslashes($_POST['NomEmpleadodep']).'"
        )';
        mysqli_query($connect, $query); 

         //Enviar la informacion capturada al email del Admin
        $message = 'You have received a contact form submission:
   
    Email: '.$_POST['email'].'
    Message: '.$_POST['message'];
    
        mail('jcorredorg@hotmail.com',
            'Contact form submission',
            $message);
        
        header('Location: thankyou.html');
        die();

    }  
}

$atencionCliente = array(
    "Juan Pérez",
    "María Rodríguez",
    "Luis González",
    "Ana Martínez"
);

$soporteTecnico = array(
    "Carlos Sánchez",
    "Laura López",
    "Pedro Ramírez",
    "Sofía Torres"
);

$facturacion = array(
    "David García",
    "Carmen Fernández",
    "Jorge Ruiz",
    "Isabel Jiménez"
);



$empleadoSeleccionado = array_rand($atencionCliente,2);

echo $atencionCliente[$empleadoSeleccionado[0]] . "\n";

$empleadoSeleccionado = array_rand($soporteTecnico,2);

echo $soporteTecnico[$empleadoSeleccionado[0]] . "\n";

$empleadoSeleccionado = array_rand($facturacion,2   );

echo $facturacion[$empleadoSeleccionado[0]] . "\n";

//echo $atencionCliente[$empleadoSeleccionado[1]] . "\n";

/*
if ($departamento === "atencion_al_cliente") {
    $empleadoSeleccionado = $atencion_al_cliente[array_rand(0, count($atencion_al_cliente) - 1)];
} elseif ($departamento === "soporte_tecnico") {
    $empleadoSeleccionado = $soporte_tecnico[array_rand(0, count($soporte_tecnico) - 1)];
} elseif ($departamento === "facturacion") {
    $empleadoSeleccionado = $facturacion[array_rand(0, count($facturacion) - 1)];
}


echo "Empleado seleccionado para el departamento de $departamento: $empleadoSeleccionado";
// Puedes acceder a los nombres de los empleados de cada departamento de la siguiente manera:
echo "Empleados del Departamento de Atención al Cliente:<br>";
foreach ($atencionCliente as $empleado) {
    echo $empleado . "<br>";
}

echo "<br>";

echo "Empleados del Departamento de Soporte Técnico:<br>";
foreach ($soporteTecnico as $empleado) {
    echo $empleado . "<br>";
}

echo "<br>";

echo "Empleados del Departamento de Facturación:<br>";
foreach ($facturacion as $empleado) {
    echo $empleado . "<br>";
}
*/

?>

<!doctype html>
<html>
    <head>
        <title>PHP Contact Form</title>
    </head>
    <body>

        <h1>PHP Contact form</h1>

        <form method="post" action="">

            Email Address:
            <br>
            <input type="text" name="email" values = "<?php echo $email; ?>">
            <?php echo $email_error; ?>

            <br></br>

            Message:
            <br>
            <textarea name="message"><?php echo $message; ?></textarea>
            <?php echo $message_error; ?>

            <br></br>
            

            NombreCliente:
            <br>
            <input type="text" name="nombreCliente" values= "<?php echo $nombreCliente; ?>">
            <?php echo $nombreCliente_error; ?>
            <br></br>


            <br>
                <label for="departamento"> Departamento</label> 
                <select name="departamento" id="departamento">
                    <option value="atencionCliente">Atención al Cliente</option>
                    <option value="soporteTecnico">Soporte Técnico</option>
                    <option value="facturacion">Facturación</option>
                </select>
            <br></br>

            <input type="submit" value="Submit">
        

            <br></br>

        </form>

    </body>
</html>


