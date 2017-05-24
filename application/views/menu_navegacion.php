<!--aparcao-->
<style>
    /*    .vertical-menu {
        }
    
        .vertical-menu a {
            background-color: #eee;  Grey background color 
            color: black;  Black text color 
            display: block;  Make the links appear below each other 
            padding: 12px;  Add some padding 
            text-decoration: none;  Remove underline from links 
        }
    
        .vertical-menu a:hover {
            background-color: #ccc;  Dark grey background on mouse-over 
        }
    
        .vertical-menu a.active {
            background-color: #4CAF50;  Add a green color to the "active/current" link 
            color: white;
        }*/
    /* Add a black background color to the top navigation */
    .topnav {
        background-color: #333;
        overflow: hidden;
    }

    /* Style the links inside the navigation bar */
    .topnav a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    /* Change the color of links on hover */
    .topnav a:hover {
        background-color: #ddd;
        color: black;
    }

    /* Add a color to the active/current link */
    .topnav a.active {
        background-color: #4CAF50;
        color: white;
    }
</style>
<div class="vertical-menu topnav">

    <?php
    if ($this->session->userdata('alumno') != null) {
        echo '<a href = "' . base_url() . 'index.php/Alumno/horario">Horario</a>';
        echo '<a href = "' . base_url() . 'index.php/Alumno/talleres">Talleres</a>';
        echo '<a href = "' . base_url() . 'index.php/Home/logout">Logout</a>';
    } elseif ($this->session->userdata('profesor') != null) {
        echo '<a href = "' . base_url() . 'index.php/Profesor/horario">Horario</a>';
        echo '<a href = "' . base_url() . 'index.php/Profesor/mis_talleres">Mis Talleres</a>';
        echo '<a href = "' . base_url() . 'index.php/Profesor/alumnos">Alumnos</a>';
        echo '<a href = "' . base_url() . 'index.php/Home/logout">Logout</a>';
    } elseif ($this->session->userdata('admin') != null) {
        echo '<a href = "' . base_url() . 'index.php/Admin/horario">Horario</a>';
        echo '<a href = "' . base_url() . 'index.php/Admin/mis_talleres">Mis Talleres</a>';
        echo '<a href = "' . base_url() . 'index.php/Admin/alumnos">Alumnos</a>';
        echo '<a href = "' . base_url() . 'index.php/Admin/configuracion">Configuración</a>';
        echo '<a href = "' . base_url() . 'index.php/Home/logout">Logout</a>';
    }
    ?>
</div>
<!--<div class="vertical-menu">
    <a href="#" class="active">Home</a>
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
    <a href="#">Link 4</a>
</div> -->