<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Machine</title>
    <link rel="shortcut icon" href="#" />
</head>

<body>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Hadiah</th>
    <th>Email</th>
    <th>No Hp</th>
    <th>Toko Daftar</th>
  </tr>
  
                                    <?php 
                                        if(!empty($list_user))
                                        { $i=1;
                                            foreach($list_user as $lst)
                                            {
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?>.</td>
                                            <td><?php echo $lst->nama; ?></td>
                                            <td><?php echo $lst->hadiah; ?></td>
                                            <td><?php echo $lst->email; ?></td>
                                            <td><?php echo $lst->no_telp; ?></td>
                                            <td><?php echo $lst->nama_toko; ?></td>
                                            <td class="text-center">
                                                <a  href="<?php echo base_url() ?>grand_draw/delete_id?id=<?php echo $lst->id; ?>" title="Delete"><i>Delete</i></a>&nbsp;
                                            </td>
                                        </tr>
                                    <?php
                                            $i++; }
                                        }
                                        ?>
</table>

</body>

</html>