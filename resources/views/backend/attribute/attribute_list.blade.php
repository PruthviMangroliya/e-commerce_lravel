@extends('backend.layout')

@section('title')
    {{ 'attribute List' }}
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>attribute</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">attribute</li>
                    <li class="breadcrumb-item active">attribute List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">


                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">attribute List</h5>
                            <button class="btn btn-primary"><a href="<?php echo url('add_attribute'); ?>" style="color:white">Add
                                    attribute</a></button>
                            <br><br>

                            <form method="GET">
                                <input type="text" class="col-sm-5" name=s_txt id="s_txt" value="<?php echo @$s_txt; ?>"
                                    placeholder="search">
                                <button class="btn btn-primary" name="search">Search</button>
                                <button class="btn btn-primary"><a href="<?php echo url('attribute_list'); ?>"
                                        style="color:white;">Reset</a></button>
                            </form>
                            <form method="POST">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select_all"></th>

                                            <th>attribute Name </th>
                                            <th></th>
                                            <th> <button class="btn btn-danger" name="del_all">Delete Selected</button></th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                    // print_r($attribute);
                                    foreach ($attributes as $attribute) {
                                        $attribute_id = $attribute->attribute_id;
                                        $attribute_name = $attribute->attribute_name;
                                        // print_r($a);
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="checked_id[]" class="checkbox"
                                                    value="<?php echo $attribute_id; ?>"></td>

                                            <td><?php echo $attribute_name; ?></td>
                                            <td><button class="btn btn-primary"><a href="<?php echo url('edit_attribute/' . $attribute_id); ?>"
                                                        style="color: white;">edit</a></button></td>
                                            <td><button class="btn btn-danger"><a href="<?php echo url('delete_attribute/' . $attribute_id); ?>"
                                                        style="color: white;">delete</a></button></td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        $(document).ready(function() {
            //=======select al par click karvathi badha select & deselect Thay==================
            $("#select_all").click(function() {
                if (this.checked) {
                    $('.checkbox').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('.checkbox').each(function() {
                        this.checked = false;
                    });
                }
            });

            //===========badha select karvathi selecte all select thay

            $('.checkbox').on('click', function() {
                //console.log($(".checkbox").length);
                //console.log($(".checkbox:checked").length)

                if ($(".checkbox:checked").length == $(".checkbox").length) {
                    $("#select_all").prop('checked', true);
                } else {
                    $("#select_all").prop('checked', false);
                }
            });
        })
    </script>
@endsection
