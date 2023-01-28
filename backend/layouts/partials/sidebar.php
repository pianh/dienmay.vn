<nav class="col-md-2 d-none d-md-block sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <!-- #################### Menu các trang Quản lý #################### -->
      <li class="nav-item sidebar_heading sidebar_heading-manage"><span>Quản lý</span></li>
      <li class="nav-item">
        <a href="/backend/pages/dashboard.php">Bảng tin <span class="sr-only">(current)</span></a>
      </li>
      <hr style="border: 1px solid red; width: 80%;" />
      <!-- #################### End Menu các trang Quản lý #################### -->

      <!-- #################### Menu chức năng Danh mục #################### -->
      <li class="nav-item sidebar_heading">
        <span>Danh mục</span>
      </li>
      <!-- Menu KHU VỰC QUẢN TRỊ-->
      <li class="nav-item sidebarSubMenu">
        <a href="#qtvSubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle btn btn-info ">
          KHU VỰC QUẢN TRỊ
        </a>
        <ul class="collapse " id="qtvSubMenu" >
          <li class="nav-item sidebarSubMenu-list" >
            <a href="/backend/chudegopy/index.php">Chủ đề GY</a>
          </li>

        </ul>
      </li>
      <!-- End Menu KHU VỰC -->

      <!-- Menu KHU VỰC QUẢN LÝ -->
      <li class="nav-item">
        <a href="#cdgySubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle btn btn-info">
          KHU VỰC QUẢN LÝ
        </a>
        <ul class="collapse" id="cdgySubMenu">
          <li class="nav-item sidebarSubMenu-list">
            <a href="/backend/chudegopy/index.php">Danh sách</a>
          </li>
          <li class="nav-item">
            <a href="/backend/chudegopy/create.php">Thêm mới</a>
          </li>
        </ul>
      </li>
      <!-- End Menu KHU VỰC QUẢN LÝ -->

      <!-- #################### End Menu chức năng Danh mục #################### -->
    </ul>
  </div>
</nav>