<div class="login-page">
  <div class="login-box">
    <div class="login-logo">
      <img src="views/dist/img/logo-visitas.png" class="img-responsive" style="padding:30px 100px 0px 100px">
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg font-weight-bold h5">Registro de Visitas y Actividades Oficiales <br>HNSEB</p>

        <form method="post">
          <div class="input-group mb-3 has-feedback">
            <input type="text" class="form-control" name="rvCuenta" id="rvCuenta" placeholder="Ingrese su usuario" autocomplete="off" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="rvClave" placeholder="Ingrese su contraseña" autocomplete="off" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-key"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8 ml-5">
              <button type="submit" class="btn btn-success btn-block btn-flat">Iniciar Sesión</button>
            </div>
          </div>
        </form>
        <?php
        $prueba = new UsuariosControlador();
        $prueba->ctrLogUsuario();
        ?>
      </div>
    </div>
  </div>
</div>