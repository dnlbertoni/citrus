<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3>Inicio de Inventario</h3>
                    </div>
                    <div class="panel-body">
                        <form >
                            <?php echo form_label('Fecha de Incio:', 'fecha_ini');?>
                            <div class="form-group">
                                <div class='input-group date' id='fecha_ini' >
                                    <?php echo form_input('fecha_ini', '', 'class="form-control" ');?>
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                </div>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                </div>
                                <button type="submit" class="btn btn-success">Iniciar</button>
                                <button type="reset" class="btn btn-danger"> Cancelar</button>
                                <button type="button" class="btn btn-info" id="btn-Back">Volver</button>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <p>estado del inventario</p>
                    </div>
                </div>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.section -->

<script>
    $(document).ready(function(){
        $('#datetimepicker1').datetimepicker();
        $("#btn-Back").click(function(){
            parent.history.back();
            return false;
        });
        $("#fecha_ini").click(function(){
            valor = $(this).attr('id');
           alert(valor);
        });
        $('#fecha_ini').datetimepicker({
            language: 'en',
            pick12HourFormat: true
        });
    });
</script>