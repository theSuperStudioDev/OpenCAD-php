<?php
if (isset($_GET['getDepartments']))
{
    getDepartments();
}
else if (isset($_GET['getLicenseStatuses']))
{
    getLicenseStatusesa();
}
else if (isset($_GET['getLicenseTypes']))
{
    getLicenseTypes();
}
else if (isset($_GET['getLicenseClasses']))
{
    getLicenseClassses();
}
else if (isset($_GET['getLicenseIssuers']))
{
    getLicenseIssuers();
}
else if (isset($_GET['getGenders']))
{
    getGenders();
}

function getDepartments()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $result = $pdo->query("SELECT * from ".DB_PREFIX."departments");
    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    foreach ($result as $row)
    {
            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
    $pdo = null;
}

/**#@+
* function getLicenseStatuses()
* Get list of possible license statuses from status() of the 'dl_status' column of the ncic_names table.
*
* @since 0.2.6
*
**/
function getLicenseStatuses()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $query = "SHOW COLUMNS FROM ".DB_PREFIX."ncic_names LIKE 'dl_status'";
    $stmt = $pdo->prepare( $query );
    if (!$stmt)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $result = $stmt -> execute();
    if ($result)
    {
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        $dl_statuses = implode($row);
        
        // Remove "set(" at start and ");" at end.
        $dl_statuses  = substr($dl_statuses,14,strlen($dl_statuses)-18);
        $dl_statuses = preg_split("/','/",$dl_statuses);
    
        foreach ($dl_statuses as $key=>$value) 
        {
            echo "<option name = '$value' value = '$value'>$value</option>\n";
        };
    }
}

/**#@+
* function getLicenseType()
* Get list of possible license types from status() of the 'dl_type' column of the ncic_names table.
*
* @since 0.2.6
*
**/
function getLicenseTypes()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $query = "SHOW COLUMNS FROM ".DB_PREFIX."ncic_names LIKE 'dl_type'";
    $stmt = $pdo->prepare( $query );
    if (!$stmt)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $result = $stmt -> execute();
    if ($result) 
    {
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        $dl_types = implode($row);
        // Remove "set(" at start and ");" at end.
        $dl_types  = substr($dl_types,12,strlen($dl_types)-16);
        $dl_types = preg_split("/','/",$dl_types);

        foreach ($dl_types as $key=>$value)
        {
            echo "<option name = '$value' value = '$value'>$value</option>\n";
        };
    }
}

function getLicenseClasses()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $query = "SHOW COLUMNS FROM ".DB_PREFIX."ncic_names LIKE 'dl_class'";
    $stmt = $pdo->prepare( $query );
    if (!$stmt)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $result = $stmt -> execute();
    if ($result) 
    {
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        $dl_classes = implode($row);

        // Remove "set(" at start and ");" at end.
        $dl_classes  = substr($dl_classes,13,strlen($dl_classes)-17);
        //echo $dl_classes;
        $dl_classes = preg_split("/','/",$dl_classes);

        foreach ($dl_classes as $key=>$value)
        {
            echo "<option name = '$value' value = '$value'>$value</option>\n";
        };
    }
}

/**#@+
* function getLicenseIssuers()
* Description of function
*
* @since version
*
**/
function getLicenseIssuers()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $query = "SHOW COLUMNS FROM ".DB_PREFIX."ncic_names LIKE 'dl_issued_by'";
    $stmt = $pdo->prepare( $query );
    if (!$stmt)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $result = $stmt -> execute();
    if ($result) 
    {
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        $dl_issuers = implode($row);
        // Remove "set(" at start and ");" at end.
        $dl_issuers  = substr($dl_issuers,14,strlen($dl_issuers)-17);
        $dl_issuers = preg_split("/','/",$dl_issuers);

        foreach ($dl_issuers as $key=>$value)
        {
            echo "<option name = '$value' value = '$value'>$value</option>\n";
        };
    }
}

/**#@+
* function getGenders()
* Get list of possible genders from set() of the 'gender' column of the ncic_names table.
*
* @since 0.2.6
*
**/
function getGenders()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $query = "SHOW COLUMNS FROM ".DB_PREFIX."ncic_names LIKE 'gender'";
    $stmt = $pdo->prepare( $query );
    if (!$stmt)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $result = $stmt -> execute();
    if ($result) 
    {
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        $genders = implode($row);
    
        // Remove "set(" at start and ");" at end.
        $genders  = substr($genders,11,strlen($genders)-15);
        $genders = preg_split("/','/",$genders);
    
        foreach ($genders as $key=>$value)
        {
            echo "<option name = '$value' value = '$value'>$value</option>\n";
        };
    }
}

?>