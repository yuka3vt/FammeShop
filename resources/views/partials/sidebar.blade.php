<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/dashboard">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
       <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
        General
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{($judul==='Dashboard')?'active':''}}">
      <a class="nav-link" href="/admin/dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
      <!-- Users -->
      <li class="nav-item {{($judul==='Daftar User')?'active':''}}">
        <a class="nav-link" href="/admin/daftar-user">
            <i class="fas fa-users"></i>
            <span>Users</span></a>
      </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Shop
        </div>
    {{-- Products --}}
    <li class="nav-item {{($judul==='Produk')?'active':''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productCollapse" aria-expanded="true" aria-controls="productCollapse">
          <i class="fas fa-cubes"></i>
          <span>Products</span>
        </a>
        <div id="productCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Product Options:</h6>
            <a class="collapse-item {{($h1==='Produk View'||$h1==='Produk Edit')?'active':''}}" href="/admin/produk-view">Products</a>
            <a class="collapse-item {{($h1==='Produk Tambah')?'active':''}}" href="/admin/produk-tambah">Add Product</a>
          </div>
        </div>
    </li>

    <!-- Categories -->
    <li class="nav-item {{($judul==='Produk Kategori')?'active':''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoryCollapse" aria-expanded="true" aria-controls="categoryProdukCollapse">
          <i class="fas fa-sitemap"></i>
          <span>Category</span>
        </a>
        <div id="categoryCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Category Options:</h6>
            <a class="collapse-item {{($h1==='Produk Kategori View'||$h1==='Kategori Produk Edit')?'active':''}}" href="/admin/produk-kategori-view">Category</a>
            <a class="collapse-item {{($h1==='Kategori Produk Tambah')?'active':''}}" href="/admin/produk-kategori-tambah">Add Category</a>
          </div>
        </div>
    </li>

    <!-- Variasis -->
    <li class="nav-item {{($judul==='Produk Variasi')?'active':''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoryVariasi" aria-expanded="true" aria-controls="categoryVariasi">
          <i class="fa fa-sliders"></i>
          <span>Variasi</span>
        </a>
        <div id="categoryVariasi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Variasi Options:</h6>
            <a class="collapse-item {{($h1==='Produk Warna View'||$h1==='Warna Produk Edit')?'active':''}}" href="/admin/produk-warna-view">Warna</a>
            <a class="collapse-item {{($h1==='Produk Ukuran View'||$h1==='Ukuran Produk Edit')?'active':''}}" href="/admin/produk-ukuran-view">Ukuran</a>
            <a class="collapse-item {{($h1==='Warna Produk Tambah')?'active':''}}" href="/admin/produk-warna-tambah">Add Warna</a>
            <a class="collapse-item {{($h1==='Ukuran Produk Tambah')?'active':''}}" href="/admin/produk-ukuran-tambah">Add Ukuran</a>
          </div>
        </div>
    </li>
    
    <!--Orders -->
    <li class="nav-item {{($judul==='Pesanan')?'active':''}}">
        <a class="nav-link" href="/admin/pesanan">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>Orders</span>
        </a>
    </li>

    {{-- <!-- Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard">
            <i class="fas fa-comments"></i>
            <span>Reviews</span></a>
    </li> --}}
    

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Posts
    </div>

    <!-- Posts -->
    <li class="nav-item {{($judul==='Blog')?'active':''}}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCollapse" aria-expanded="true" aria-controls="postCollapse">
        <i class="fas fa-fw fa-folder"></i>
        <span>Blog</span>
      </a>
      <div id="postCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Blog Options:</h6>
          <a class="collapse-item {{($h1==='Blog View'||$h1==='Blog Edit')?'active':''}}" href="/admin/blog-view">Blogs</a>
          <a class="collapse-item {{($h1==='Blog Tambah')?'active':''}}" href="/admin/blog-tambah">Add Blog</a>
        </div>
      </div>
    </li>

     <!-- Category -->
     <li class="nav-item {{($judul==='Blog Kategori')?'active':''}}">
        <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#postCategoryCollapse" aria-expanded="true" aria-controls="postCategoryCollapse">
          <i class="fas fa-sitemap fa-folder"></i>
          <span>Category</span>
        </a>
        <div id="postCategoryCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Category Options:</h6>
            <a class="collapse-item {{($h1==='Kategori Blog View'||$h1==='Kategori Blog Edit')?'active':''}}" href="/admin/blog-kategori-view">Category</a>
            <a class="collapse-item {{($h1==='Kategori Blog Tambah')?'active':''}}" href="/admin/blog-kategori-tambah">Add Category</a>
          </div>
        </div>
      </li>
 
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>