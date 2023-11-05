<?php
$titre = "Supression";
require_once "../../controller/controller.php";
if(isset($_GET["id"]))
{
    supperssion($_GET["id"]);
    header("location:".URL);
}