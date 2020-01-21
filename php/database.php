<?php
    //This page serves as the UI for making and managing databases and datatables.

    include ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/admin.php");
?>
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