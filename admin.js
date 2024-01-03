$( document ).ready(function() {
    show_tabel('USERS')
});
function show_tabel(nume_tabel) {
    $("#table_container").load("load-table.php", {
        table_name: nume_tabel.toUpperCase()
    });
    $("#form-delete").load("load-select.php", {
        table_name: nume_tabel.toUpperCase(),
        action: 'DELETE'
    });
    $("#form-modify").load("load-select.php", {
        table_name: nume_tabel.toUpperCase(),
        action: 'MODIFY'
    });
    $("#form-insert").load("load-select.php", {
        table_name: nume_tabel.toUpperCase(),
        action: 'INSERT'
    });
}