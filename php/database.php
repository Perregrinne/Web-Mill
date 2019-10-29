<?php
    //This page serves as the UI for making and managing databases and datatables.

    include ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php");
?>
<style>
    #database-manager {
        margin-left: 65px;
    }
    h3, select {
        margin-left: 65px;
        margin-bottom: 25px;
        z-index: -1;
    }
    select {
        color: #DDDDDD;
        background-color: #333333;
        min-width: 150px;
        z-index: -1;
    }
    #database-break {
        border-color: #CCCCCC;
        z-index: -1;
    }
    #table-default {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        margin: 0 65px 0 65px;
        max-width: 100%;
        min-width: 90%;
        z-index: -1;
    }
    input {
        font-family: arial, sans-serif;
        border: none;
        outline: 1px solid #333333;
        color: #DDDDDD;
        background-color: #555555;
        z-index: -1;
        padding: 5px;
    }
    td, th {
        border: 2px solid #222222;
        text-align: left;
        padding: 8px;
        min-width: 25px;
        max-width: 100px;
        z-index: -1;
    }
    #new-col {
        background-color: #33AA33;
    }
    #new-col:hover {
        background-color: #33CC33;
    }
    tr:nth-child(even) {
        background-color: #555555;
        z-index: -1;
    }
    tr:nth-child(odd) {
        background-color: #333333;
        z-index: -1;
    }
</style>
<body style="background-color: #444444; color: #DDDDDD;">
<h1 id="database-manager">Database Manager</h1>
<hr id="database-break">
<h3 id="rdbms">Database Management System:</h3>
<select id="db-option">
  <option value="SQLite3">SQLite3</option>
  <option value="MySQL">MySQL</option>
  <option value="PostgreSQL">PostreSQL</option>
</select>
<h3 id="table-name"><input type="text" name="TableName" value="TableName"></h3>
    <table id="table-default">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Info</th>
            <th>Join Date</th>
            <th>Last Modified</th>
            <th id="new-col">+ New Column</th>
        </tr>
        <tr>
            <td>Integer</td>
            <td>Text</td>
            <td>Blob</td>
            <td>Datetime</td>
            <td>Datetime</td>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>