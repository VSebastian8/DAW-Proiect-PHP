$( document ).ready(function() {
    $("#table_container").load("load-table.php", {
        table_name: "USERS"
    });
});
function show_tabel(nume_tabel) {
    $("#table_container").load("load-table.php", {
        table_name: nume_tabel.toUpperCase()
    });
}