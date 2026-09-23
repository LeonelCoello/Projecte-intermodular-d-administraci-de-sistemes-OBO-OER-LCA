AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
?>
AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)
?>

*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connecmt_error) {
    die("Connexió fallida: " . $conn->connect_error);
}
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***

<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>



*** DELETE.PHP ***

<?php
include 'db.php';

$id = (int)$_GET['id'];
$conn->query("DELETE * FROM users WHERE id=$id");

header("Location: index.php");
exit;
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";Para organizar la migración de un Active Directory On-Premises a Azure Active Directory / Microsoft Entra ID bajo el marco **Scrum**, he estructurado el **Backlog del Producto** dividiéndolo en **Epics** (Grandes bloques) e **Historias de Usuario / Tasks** detalladas.

---

## 1. Fase de Análisis, Descubrimiento e Infraestructura (Epic 1)

* **AN-01: Inventario de Identidades y Grupos**
* *Historia:* Como Administrador de Sistemas, quiero auditar las cuentas de usuario, grupos y equipos existentes en el AD On-Premises para identificar qué cuentas deben migrarse, desactivarse o depurarse.


* **AN-02: Evaluación de Aplicaciones y Dependencias**
* *Historia:* Como Arquitecto Cloud, quiero mapear las aplicaciones que dependen de Kerberos/NTLM/LDAP para determinar cuáles se pueden migrar a OAuth2/SAML/OIDC y cuáles requerirán Microsoft Entra Domain Services (DS).


* **AN-03: Auditoría de Directivas de Grupo (GPOs)**
* *Historia:* Como Sysadmin, quiero analizar las GPOs locales vigentes para mapear su equivalente en directivas de Intune (MDM) o Microsoft Endpoint Manager.


* **AN-04: Diseño de la Arquitectura de Identidad en Azure**
* *Historia:* Como Arquitecto Cloud, quiero definir el modelo de identidad (Híbrida temporal vs. Cloud-Native directa) y la estructura de dominios en Microsoft Entra ID.



---

## 2. Preparación y Sincronización Híbrida (Epic 2)

* **PREP-01: Preparación del Dominio y Limpieza de UPNs**
* *Historia:* Como Sysadmin, quiero validar y cambiar los UPNs locales (ej. `.local`) a un dominio enrutable verificado en Azure (ej. `.com`) para garantizar un inicio de sesión unificado.


* **PREP-02: Despliegue y Configuración de Microsoft Entra Connect (AZ AD Connect)**
* *Historia:* Como Sysadmin, quiero instalar Microsoft Entra Connect en un servidor local para realizar la primera sincronización de usuarios y grupos hacia la nube.


* **PREP-03: Configuración del Método de Autenticación**
* *Historia:* Como Ingeniero de Seguridad, quiero configurar Password Hash Synchronization (PHS) o Pass-Through Authentication (PTA) según los requerimientos de la empresa para habilitar el inicio de sesión único (SSO).


* **PREP-04: Configuración de Reglas de Filtrado de Sincronización**
* *Historia:* Como Sysadmin, quiero configurar los filtros de OUs y atributos en Entra Connect para evitar sincronizar objetos no deseados (cuentas de servicio locales, grupos obsoletos).



---

## 3. Seguridad, Directivas y Gobernanza (Epic 3)

* **SEC-01: Implementación de Autenticación Multi-Factor (MFA)**
* *Historia:* Como Responsables de Ciberseguridad, queremos activar MFA obligatorio para todos los usuarios sincronizados mediante Directivas de Acceso Condicional (Conditional Access).


* **SEC-02: Configuración de Acceso Condicional**
* *Historia:* Como Ingeniero de Seguridad, quiero definir reglas de acceso basadas en ubicación, estado del dispositivo y nivel de riesgo.


* **SEC-03: Migración de Políticas de Dispositivos a Microsoft Intune**
* *Historia:* Como Sysadmin, quiero recrear las políticas de seguridad (GPOs) dentro de Intune para preparar la gestión de equipos Windows 10/11 sin dependencia del controlador de dominio local.



---

## 4. Migración de Equipos y Recursos (Epic 4)

* **MIG-01: Migración de Servidores de Archivos a Microsoft 365 / Azure Files**
* *Historia:* Como Administrador de Almacenamiento, quiero migrar las carpetas compartidas locales a SharePoint Online/OneDrive o Azure Files con permisos RBAC.


* **MIG-02: Despliegue e Inscripción de Dispositivos en Entra ID / Intune**
* *Historia:* Como Técnico de Soporte, quiero desvincular los equipos del dominio local (Hybrid Join) o unirlos directamente a Microsoft Entra ID (Entra Joined) para liberarlos del AD físico.


* **MIG-03: Reconfiguración de Servicios de Red (DNS / DHCP / VPN / Wi-Fi RADIUS)**
* *Historia:* Como Ingeniero de Redes, quiero reconfigurar el servidor DNS local y la autenticación RADIUS/VPN para que funcionen con identidades de la nube o certs de Intune.



---

## 5. Pruebas, Transición y Desconexión (Epic 5)

* **QA-01: Piloto de Validación de Identidad y Dispositivos**
* *Historia:* Como Product Owner, quiero realizar una prueba piloto con un departamento restringido para validar SSO, acceso a carpetas, correo y aplicaciones sin impacto en producción.


* **QA-02: Plan de Comunicación y Capacitación al Usuario Final**
* *Historia:* Como Scrum Master/Gestor del Cambio, quiero preparar guías de inicio rápido e informar a los usuarios sobre el cambio de credenciales y la verificación MFA.


* **CUT-01: Ventana de Transición Final (Cutover)**
* *Historia:* Como Equipo Scrum, queremos realizar el corte definitivo del AD local, convirtiendo las cuentas sincronizadas en cuentas 100% nube ("Cloud-Only").


* **CUT-02: Desmantelamiento (Decommissioning) del AD On-Premises**
* *Historia:* Como Sysadmin, quiero apagar y degradar de forma segura los Controladores de Dominio (DCs) locales una vez verificado el correcto funcionamiento total.



---
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***
?php
100
include 'db.php';
101
​
102
if (isset($_GET['id'])) {
103
    $id = (int)$_GET['id'];
104
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
105
    $user = $result->fetch_assoc();
106
}
107
​
108
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
109
    $id    = (int)$_POST['id'];
110
    $name  = $_POST['name'];
111
    $email = $_POST['email'];
112
​
113
    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
114
    $stmt->bind_param("ssi", $name, $email, $id);
115
    $stmt->execute();
116
​
117
    header("Location: index.php");
118
    exit;
119
}
120
?>
121
​
122
<!DOCTYPE html>
123
<html lang="ca">
124
<head>
125
    <meta charset="UTF-8">
126
    <title>Editar usuari</title>
127
</head>
128
<body>
129
    <h1>Editar usuari</h1>
130
    <form method="post">
131
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
132
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
133
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
134
        <button type="submit">Desar</button>
135
    </form>
136
</body>
137
</html>
138
​
139
​
140
​
141
*** DELETE.PHP ***
142
​
143
<?php
144
include 'db.php';
145
​
146
$id = (int)$_GET['id'];
147
$conn->query("DELETE * FROM users WHERE id=$id");
148
​
149
header("Location: index.php");
150
exit;
151
?>
152
​
￼
￼
￼
￼
<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
?>
AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
?>
AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***

<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>



*** DELETE.PHP ***

<?php
include 'db.php';

$id = (int)$_GET['id'];
$conn->query("DELETE * FROM users WHERE id=$id");

header("Location: index.php");
exit;
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***
?php
100
include 'db.php';
101
​
102
if (isset($_GET['id'])) {
103
    $id = (int)$_GET['id'];
104
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
105
    $user = $result->fetch_assoc();
106
}
107
​
108
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
109
    $id    = (int)$_POST['id'];
110
    $name  = $_POST['name'];
111
    $email = $_POST['email'];
112
​
113
    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
114
    $stmt->bind_param("ssi", $name, $email, $id);
115
    $stmt->execute();
116
​
117
    header("Location: index.php");
118
    exit;
119
}
120
?>
121
​
122
<!DOCTYPE html>
123
<html lang="ca">
124
<head>
125
    <meta charset="UTF-8">
126
    <title>Editar usuari</title>
127
</head>
128
<body>
129
    <h1>Editar usuari</h1>
130
    <form method="post">
131
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
132
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
133
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
134
        <button type="submit">Desar</button>
135
    </form>
136
</body>
137
</html>
138
​
139
​
140
​
141
*** DELETE.PHP ***
142
​
143
<?php
144
include 'db.php';
145
​
146
$id = (int)$_GET['id'];
147
$conn->query("DELETE * FROM users WHERE id=$id");
148
​
149
header("Location: index.php");
150
exit;
151
?>
152
​
￼
￼
￼
￼
<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
?>
AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
?>
AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***

<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>



*** DELETE.PHP ***

<?php
include 'db.php';

$id = (int)$_GET['id'];
$conn->query("DELETE * FROM users WHERE id=$id");

header("Location: index.php");
exit;
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***
?php
100
include 'db.php';
101
​
102
if (isset($_GET['id'])) {
103
    $id = (int)$_GET['id'];
104
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
105
    $user = $result->fetch_assoc();
106
}
107
​
108
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
109
    $id    = (int)$_POST['id'];
110
    $name  = $_POST['name'];
111
    $email = $_POST['email'];
112
​
113
    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
114
    $stmt->bind_param("ssi", $name, $email, $id);
115
    $stmt->execute();
116
​
117
    header("Location: index.php");
118
    exit;
119
}
120
?>
121
​
122
<!DOCTYPE html>
123
<html lang="ca">
124
<head>
125
    <meta charset="UTF-8">
126
    <title>Editar usuari</title>
127
</head>
128
<body>
129
    <h1>Editar usuari</h1>
130
    <form method="post">
131
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
132
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
133
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
134
        <button type="submit">Desar</button>
135
    </form>
136
</body>
137
</html>
138
​
139
​
140
​
141
*** DELETE.PHP ***
142
​
143
<?php
144
include 'db.php';
145
​
146
$id = (int)$_GET['id'];
147
$conn->query("DELETE * FROM users WHERE id=$id");
148
​
149
header("Location: index.php");
150
exit;
151
?>
152
​
￼
￼
￼
￼
<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP *** ￼
Personal access token


<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
?>
AP Projecte ASIXc2Codi en PHP

*** Estructura del projecte i codi a desplegar ***
app/
 ├── db.php         (connexió a la BBDD)
 ├── index.php      (llista usuaris + formulari per afegir-ne)
 ├── add.php        (afegeix usuari)
 ├── delete.php     (elimina usuari)
 └── edit.php       (edita usuari)


*** DB.PHP ***

<?php
$servername = "locahost";
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***

<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>



        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***

<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>



<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***

<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (*, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();

header("Location: index.php");
exit;
?>

ls membres de l’equip pugueu escriure i commitar-hi el codi del codes
*** EDIT.PHP ***

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>



*** DELETE.PHP ***

<?php
include 'db.php';

$id = (int)$_GET['id'];
$conn->query("DELETE * FROM users WHERE id=$id");

header("Location: index.php");
exit;
?>

*** Script de Mysql per crear la BBDD ***

CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);


*** INDEX.PHP ***

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table>
    <table border="1">
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="posts">
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>


*** ADD.PHP ***
?php
100
include 'db.php';
101
​
102
if (isset($_GET['id'])) {
103
    $id = (int)$_GET['id'];
104
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
105
    $user = $result->fetch_assoc();
106
}
107
​
108
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
109
    $id    = (int)$_POST['id'];
110
    $name  = $_POST['name'];
111
    $email = $_POST['email'];
112
​
113
    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");
114
    $stmt->bind_param("ssi", $name, $email, $id);
115
    $stmt->execute();
116
​
117
    header("Location: index.php");
118
    exit;
119
}
120
?>
121
​
122
<!DOCTYPE html>
123
<html lang="ca">
124
<head>
125
    <meta charset="UTF-8">
126
    <title>Editar usuari</title>
127
</head>
128
<body>
129
    <h1>Editar usuari</h1>
130
    <form method="post">
131
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
132
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
133
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
134
        <button type="submit">Desar</button>
135
    </form>
136
</body>
137
</html>
138
​
139
​
140
​
141
*** DELETE.PHP ***
142
​
143
<?php
144
include 'db.php';
145
​
146
$id = (int)$_GET['id'];
147
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>



*** DELETE.PHP ***

<?php
include 'db.php';

$id = (int)$_GET['id'];
$conn->query("DELETE * FROM users WHERE id=$id");

header("Location: index.php");
exit;
?>
