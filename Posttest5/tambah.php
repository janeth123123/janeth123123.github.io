<h3> Tambah anggota</h3>

<form action="" method="post">
    <table>
        <tr>
            <td width="130"> id anggota </td>
            <td> <input type="text" name="id_anggota"></td>

            </tr>
            <tr>
            <td > nama anggota </td>
            <td> <input type="text" name="nama_anggota"></td>
            
            </tr>
            <tr>
            <td > umur anggota </td>
            <td> <input type="text" name="umur_anggota"></td>
            </tr>
            <tr>
            <td > kata sandi </td>
            <td> <input type="text" name="kata_sandi"></td>
            </tr>
            <tr>
            <td > </td>
            <td> <input type="submit" value="Simpan" name="proses"></td>
            

            </tr>
    </form>

    <?php
    include "koneksi.php";

    if(isset($_POST['proses'])){
        mysqli_query($koneksi,"insert into anggota set
         id_anggota =  '$_POST[id_anggota]',
         nama_anggota = '$_POST[nama_anggota]',
         umur_anggota ='$_POST[umur_anggota]',
         kata_sandi = '$_POST[kata_sandi]'");

         echo "data anggota baru telah tersimpan";
    }