<div class="container-fluid">
    <div class="row">
        <?php if ($this->session->flashdata('msg')) { ?>
            <div class="alert <?php echo $this->session->flashdata('alert') ?>  alert-dismissible" style="margin-bottom: 0; margin-top: 20px" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong><?php echo $this->session->flashdata('msg') ?></strong>
            </div>
        <?php } ?>
        <div class="col-lg-12">
            <h2 class="page-header"><i class="fa fa-fw fa-sticky-note-o"></i>Order
            </h2>
        </div><br>
    </div>
    <?php echo form_open(site_url('manage/order/delete_all/'), 'id="delall"') ?>
    <div class="col-lg-12">
        <?php if ($item) { ?>
            <div class="float-left">
                <button type="submit" class="btn btn-default" id="delete_all"><i class="fa fa-fw fa-trash"></i></button>
            </div>
        <?php } ?>
    </div><br>
    <?php if ($item == FALSE) { ?>
        <br>
        <h4 class="text-center"><?php echo 'Data order kosong.';?></h4>
    <?php } else { ?>
        <div class="col-lg-12">
            <div class="row">
                <div class = "col-xs-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dtable">
                            <thead>
                                <tr>
                                    <th class="text-center no-sort"><input type="checkbox" id="checkall" name="checkall"/></th>
                                    <th class="">No</th>
                                    <th class="text-center">id order</th>
                                    <th class="text-center">jenis order</th>
                                    <th class="text-center">tgl order</th>
                                    <th class="text-center">waktu penjemputan</th>
                                    <th class="text-center">customer</th>
                                    <th class="text-center">id kurir - nama</th>
                                    <th class="text-center">status</th>
                                    <th class="text-center no-sort"><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($item as $i) {
                                    switch($i['status']){
                                        case 1:
                                            $i['status'] = 'Menunggu penjemputan';
                                            break;
                                        case 2:
                                            $i['status'] = 'Sudah di jemput';
                                            break;
                                        case 3:
                                            $i['status'] = 'Diproses';
                                            break;
                                        case 4:
                                            $i['status'] = 'Pengantaran';
                                            break;
                                        case 5:
                                            $i['status'] = 'Diterima';
                                            break;
                                        default:
                                            $i['status'] = '';
                                    }
                                    ?>

                                    <tr>
                                        <td class="text-center"><input type="checkbox" id="pcheck[]" name="pcheck[]" value="<?php echo $i['id'] ?>"/></td>
                                        <td class=""><?php echo $no ?></td>
                                        <td class=""><?php echo $i['id'] ?></td>
                                        <td class=""><?php echo (!empty($i['premium'])) ? 'Premium' : 'Paket hemat'?></td>
                                        <td class="text-center"><?php echo date('d-m-Y H:i', strtotime($i['tanggal_order'])) ?></td>
                                        <td class="text-center"><?php echo date('H:i', strtotime($i['penjemputan_waktu'])) ?></td>
                                        <td class="text-center"><?php echo $i['nama_user'] ?></td>
                                        <td class=""><?php echo $i['kurir_id'].' - '.$i['nama_kurir'] ?></td>
                                        <td class="text-center"><?php echo $i['status'] ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('manage/order/edit/' . $i['id']) ?>" class="btn btn-default btn-sm" title="Edit"><i class="fa fa-edit text-primary"></i></a>
                                            <button id="delete" type="button" class="btn btn-default btn-sm" data-url="<?php echo site_url('manage/order/delete/' . $i['id']) ?>" data-toggle="modal" data-target="#delete-modal" data-backdrop="static" data-keyboard="false" title="Hapus"><i class="fa fa-close text-danger"></i></button>
                                        </td>
                                    </tr>
                                    <?php
                                    $no+=1;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    ?>
    <?php echo form_close() ?>
    <div class="clearfix"></div> 
</div>
<div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-confirm">
            <div class="modal-body text-center text-semi-bold">
                <p><i class="fa fa-info-circle text-warning fa-2x"></i></p>
                <p>Data ini akan dihapus. Lanjutkan ?</p>
                <div class="text-center">
                    <a href="" class="btn btn-primary btn-sm" id="btn-modal-delete">Ya</a>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tidak</button>           
                </div>
            </div>
        </div>
    </div>
</div>