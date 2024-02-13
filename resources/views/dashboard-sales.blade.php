@extends('layouts.master')
@section('content')



<div class="row mb-3">

    <div class="col-xl-12 col-lg-12 mb-4">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Customer</h6>
       
                <a class="m-0 float-right btn btn-danger btn-sm text-white" type="button" onclick="addnewss()">Tambah  <i class="fas fa-plus"></i></a>
               

            </div>
           
            <div class="table-responsive">
  
                <table class="table align-items-center table-flush " id="datass">
                  
                        <thead class="thead-light">


                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>No Telpon</th>
                                <th>Alamat</th>
                                <th>Paket Dipilih</th>
                                <th>Foto KTP</th>
                                <th>Foto Rumah</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

</div>




{{-- Modal --}}



<div class="modal fade" id="ModalTambahSS" tabindex="-1" aria-labelledby="ModalTambahSSLabel" aria-hidden="true">
<div id="loader" ></div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTambahSSLabel">Tambah Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="addss">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" id="nama" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">NO. Telp</label>
                        <div class="col-sm-9">
                            <input type="text" id="no_telp" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" id="alamat" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Paket Dipilih</label>
                        <div class="col-sm-9">
                            <!-- <input type="text" id="nama_kapal" class="form-control"> -->
                            <select id="paket" class="form-control">
                             <option value="">~ Pilih PAKET ~</option>

                            </select>
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Foto KTP</label>
                        <div class="col-sm-9">
                            <!-- <input type="text" id="foto_slideshow" class="form-control"> -->

                            <div class="form-group upimageposting">
                                <button type="button" class="btn btn-primary btn-border btn-block" onclick="document.getElementById('uploadimagefileposting').click()">
                                    <i class="fa fa-camera" aria-hidden="true" style="font-size: 50px;"></i>
                                </button>
                            </div>
                            <img id="img-uploadposting" src='' alt="" class="img-uploadposting d-none w-100" onclick="document.getElementById('uploadimagefileposting').click()">
                            <input type="file" onchange="readURLfotoposting(this);" class="d-none" name="foto_slideshow" accept="image/*" id="uploadimagefileposting"></input>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Foto Rumah</label>
                        <div class="col-sm-9">
                            <!-- <input type="text" id="foto_slideshow" class="form-control"> -->

                            <div class="form-group upimageposting2">
                                <button type="button" class="btn btn-primary btn-border btn-block" onclick="document.getElementById('uploadimagefileposting2').click()">
                                    <i class="fa fa-camera" aria-hidden="true" style="font-size: 50px;"></i>
                                </button>
                            </div>
                            <img id="img-uploadposting2" src='' alt="" class="img-uploadposting d-none w-100" onclick="document.getElementById('uploadimagefileposting2').click()">
                            <input type="file" onchange="readURLfotoposting2(this);" class="d-none" name="foto_slideshow" accept="image/*" id="uploadimagefileposting2"></input>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tambahkanss">Tambahkan</button>
                <button type="button" aidi_ss="" class="btn btn-primary" id="editkanss">Update</button>
            </div>
        </div>
    </div>
</div>



{{-- Modal --}}



@endsection

@section('js')





<script>
    $(document).ready(function() {
        getslideshow()
        getpaket()
    })

    $("#tambahkanss").click(() => {
             
      
        
        $("#addss input[type='text']").removeClass('is-invalid')
        $("#addss textarea").removeClass('is-invalid')
        var jmla = 0
        $("#addss input[type='text']").each((i, a) => {
            if ($(a).val() == "") {
                $(a).addClass('is-invalid')
                jmla++
            }
        })
        if ($("#addss textarea").val() == "") {
            $("#addss textarea").addClass('is-invalid')
        }
        if (jmla == 0 && $("#addss textarea").val() != "") {
            tambahss()
        }
    })

    $("#editkanss").click(() => {
        $("#adsspostingan input[type='text']").removeClass('is-invalid')
        $("#addss textarea").removeClass('is-invalid')
        var jmla = 0
        $("#addss input[type='text']").each((i, a) => {
            if ($(a).val() == "") {
                $(a).addClass('is-invalid')
                jmla++
            }
        })
        if ($("#addss textarea").val() == "") {
            $("#addss textarea").addClass('is-invalid')
        }
        if (jmla == 0 && $("#addss textarea").val() != "") {
            updatess($("#editkanss").attr("aidi_ss"))
        }
    })

    function addnewss() {
        $("#loader").addClass('d-none')
        $("#ModalTambahSSLabel").html("Tambah Informasi")
        $("#tambahkanss").removeClass('d-none')
        $("#editkanss").addClass('d-none')
        $('#ModalTambahSS').modal('show')
        $("#addss input[type='text']").val('')
        $("#addss textarea").val('')
        $('.upimageposting').removeClass('d-block').addClass('d-block').removeClass('d-none')
        $('#img-uploadposting').removeClass('d-none').addClass('d-none').removeClass('d-block')
    }

    async function getslideshow() {
        await axios.get("{{url('api/data-customer')}}")
            .then((res) => {
                $("#datass").DataTable().destroy()
                $("#datass tbody").empty()
           
               
                $no=1
                res.data.forEach((data) => {
                    $("#datass tbody").append(
                        ` <tr>
                        <td>` + ($no++) + `</td>
                        <td><a href="#">` + data.nama + `</a></td>
                        <td><a href="#">` + data.no_telp + `</a></td>
                        <td><a href="#">` + data.alamat + `</a></td>
                        <td><a href="#">` + data.nama_paket + `</a></td>
                        <td>'<img src="public/foto_ktp/${data.foto_ktp}" alt="..."  style=" height:60px; width:100px;">'</td>
                        <td>'<img src="public/foto_rumah/${data.foto_rumah}" alt="..."  style=" height:60px; width:100px;">'</td>
                    
                        <td><a  class="btn text-white btn-sm btn-primary" onclick="editss(` + data.id + `)">        <i class="fas fa-edit  fex-2"></i> </a>
                        <a class="btn text-white btn-sm btn-danger" onclick="hapusss(` + data.id + `,'` + data.nama + `')"> <i class="fas fa-trash fex-2 "></i></a>
                        </td>
                    </tr>
                `
                    )
                })
            })
        $("#datass ").DataTable()
    }


    async function tambahss() {
        var nama = $("#nama").val()
        var no_telp = $("#no_telp").val()
        var alamat = $("#alamat").val()
        var paket = $("#paket").val()
        file = $("#uploadimagefileposting")
    

        let data = new FormData();
        data.append('foto_ktp', document.getElementById('uploadimagefileposting').files[0]);
        data.append('foto_rumah', document.getElementById('uploadimagefileposting2').files[0]);
        data.append('nama', nama)
        data.append('no_telp', no_telp)
        data.append('alamat', alamat)
        data.append('paket_penjualan_id', paket)

        const config = {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        };
        $('#loader').removeClass('d-none')
        await axios.post("{{url('api/add-customer')}}", data, config)
            .then((res) => {
                console.log(res)
                $('#ModalTambahSS').modal('hide')
                getslideshow()
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data Customer Telah ditambahkan'
                })
            })
            // $('.loader').addClass('d-none')
            console.log(res)
    }

    async function updatess(id) {
        var nama = $("#nama").val()
        var no_telp = $("#no_telp").val()
        var alamat = $("#alamat").val()
        var paket = $("#paket").val()
        file = $("#uploadimagefileposting")
       

        let data = new FormData();
        data.append('foto_ktp', document.getElementById('uploadimagefileposting').files[0]);
        data.append('foto_rumah', document.getElementById('uploadimagefileposting2').files[0]);
        data.append('nama', nama)
        data.append('no_telp', no_telp)
        data.append('alamat', alamat)
        data.append('paket_penjualan_id', paket)
      
        const config = {
            headers: {
                'Content-Type': 'multipart/form-data'
            },
        };
        $('#loader').removeClass('d-none')

        await axios.post("{{url('api/update-customer')}}" + "/" + id, data, config)
            .then((res) => {
                console.log(res)
                $('#ModalTambahSS').modal('hide')
                getslideshow()
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data Customer Berhasil Diubah'
                })
            })
    }

    function hapusss(id, pemilik) {
        Swal.fire({
            title: 'Apakah Anda Menghapus Informasi ' + pemilik + '?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Hapus`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                axios.delete("{{url('api/hapus-customer')}}" + "/" + id).then((res) => {
                    getslideshow()
                    Swal.fire('Informasi ' + pemilik + ' Berhasil Dihapus', '', 'success')
                })
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    }

    async function editss(id) {
        $("#loader").addClass('d-none')
        $("#ModalTambahSSLabel").html("Update Informasi")
        $("#tambahkanss").addClass('d-none')
        $("#editkanss").removeClass('d-none')
        $("#editkanss").attr("aidi_ss", id)
        await axios.get("{{url('api/get-customer')}}" + "/" + id)

            .then((res) => {
                console.log(res.data.id)
                $('#ModalTambahSS').modal('show')
                $("#nama").val(res.data.nama)
                $("#alamat").val(res.data.alamat)
                $("#no_telp").val(res.data.no_telp)
                $("#paket_id").val(res.data.paket_penjualan_id)
                $('.upimageposting').removeClass('d-none').addClass('d-none').removeClass('d-block')
                $('#img-uploadposting').removeClass('d-block').addClass('d-block').removeClass('d-none')
                $('.upimageposting2').removeClass('d-none').addClass('d-none').removeClass('d-block')
                $('#img-uploadposting2').removeClass('d-block').addClass('d-block').removeClass('d-none')
                $('#img-uploadposting').attr('src', "{{url('public/foto_ktp')}}" + '/' + res.data.foto_ktp);
                $('#img-uploadposting2').attr('src', "{{url('public/foto_rumah')}}" + '/' + res.data.foto_rumah);

            })
    }

    function readURLfotoposting(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            $('.upimageposting').removeClass('d-none').addClass('d-none').removeClass('d-block')
            $('#img-uploadposting').removeClass('d-block').addClass('d-block').removeClass('d-none')

            reader.onload = function(e) {
                $('#img-uploadposting')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    
    function readURLfotoposting2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            $('.upimageposting2').removeClass('d-none').addClass('d-none').removeClass('d-block')
            $('#img-uploadposting2').removeClass('d-block').addClass('d-block').removeClass('d-none')

            reader.onload = function(e) {
                $('#img-uploadposting2')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    async function getpaket() {

axios.get("{{url('api/get-paket')}}").then((res) => {
    $("#paket").empty()
    res.data.forEach(function(item, key) {
        const optionText = item.nama_paket + " - " + item.harga;
        $('#paket').append($('<option>', {
            value: item.id,
            text:optionText
        }));
    });
});

}

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dataP').DataTable();
    });
</script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>



@endsection