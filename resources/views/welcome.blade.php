<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>images lib | @yield('title')</title>
  @yield('styles')
  <link rel="stylesheet" href="{{ asset('/dashboard/css/styles.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('/libs/swiper.css') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800&display=swap"
    rel="stylesheet">
  <style>
    * {
      font-family: 'Cairo', sans-serif !important;
    }
    .left-sidebar {
      border-left: 1px solid rgb(229,234,239);
    }
    img {
      max-width: 300px
    }
    .pop-up {
      margin: auto;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      max-width: 500px;
      z-index: 99999999;
    }
    .hide-content {
      width: 100vw;
      height: 100vh;
      background-color: #0000004d;
      position: fixed;
      top: 0;
      left: 0;
      z-index: calc(99999993 - 1);
    }
    .img:hover .settings {
        opacity: 1;
    }
    .img .settings {
        opacity: 0;
        transition: all .3s ease-in
    }
    .img .settings svg {
        stroke: white
    }
    #errors {
      position: fixed;
      top: 1.25rem;
      right: 1.25rem;
      display: flex;
      flex-direction: column;
      max-width: calc(100% - 1.25rem * 2);
      gap: 1rem;
      z-index: 99999999999999999999;

    }
    #errors >* {
      width: 100%;
      color: #fff;
      font-size: 1.1rem;
      padding: 1rem;
      border-radius: 1rem;
      box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    #errors .error {
      background: #e41749;
    }
    #errors .success {
      background: #12c99b;
    }
    .loader {
      width: 100vw;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      justify-content: center;
      align-items: center;
      z-index: 9999999999999999999999999999999999 !important;
      background: #fafafa !important;
      backdrop-filter: blur(1px);
      display: flex
    }
    .custom-loader {
      --d:22px;
      width: 4px;
      height: 4px;
      border-radius: 50%;
      color: #365FA0;
      box-shadow: 
        calc(1*var(--d))      calc(0*var(--d))     0 0,
        calc(0.707*var(--d))  calc(0.707*var(--d)) 0 1px,
        calc(0*var(--d))      calc(1*var(--d))     0 2px,
        calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
        calc(-1*var(--d))     calc(0*var(--d))     0 4px,
        calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
        calc(0*var(--d))      calc(-1*var(--d))    0 6px;
      animation: s7 1s infinite steps(8);
    }

    @keyframes s7 {
      100% {transform: rotate(1turn)}
    }

    .show {
      display: block !important;
    }
  </style>
</head>

<body>
  <div id="errors"></div>
  <div class="loader">
    <div class="custom-loader"></div>
  </div>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper" id="images_wrapper">
      <!--  Header Start -->
      <!--  Header End -->
      <div class="container-fluid">
        {{-- button to show lin --}}
        <button @click="showImages = true" class="btn btn-primary">show libarary</button>
        {{-- images lib show --}}
        <div class="pop-up show-images-pop-up card" v-if="showImages" style="min-width: 90vw;height: 90vh;padding: 20px;display: flex;flex-direction: column;justify-content: space-between;gap: 1rem;">
            <input type="text" name="search" id="search" class="form-control w-25 mb-2" placeholder="Search" v-model="search" @input="getSearchImages(this.search)">
            <div class="imgs p-2 gap-3" v-if="images && images.length" style="display: flex;grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));flex-wrap: wrap;height: 100%;overflow: auto;">
                <div class="img"  v-for="(img, index) in images" :key="img.id" style="position: relative;width: 260px;height: 230px;overflow: hidden;padding: 10px;border-radius: 1rem;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                    <img :src="'{{ asset("/images/uploads") }}/' + img.path" id="preview" alt="img logo" style="width: 100%;height: 100%;object-fit: contain;">
                    <div class="settings" style="gap: 10px;position: absolute;top: 0;left: 0;width: 100%;display: flex;justify-content: center;align-items: center;background: #00000069;height: 100%;">
                        <button class="btn btn-primary" @click="img_for_seo = img; img_for_seo_title = img.title;img_for_seo_alt = img.alt;this.showSettingsPopUp = true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-seo" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M7 8h-3a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-3" />
                            <path d="M14 16h-4v-8h4" />
                            <path d="M11 12h2" />
                            <path d="M17 8m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                          </svg>
                        </button>
                        <button class="btn btn-success" @click="this.current_img = '{{ asset("/images/uploads") }}/' + img.path;this.current_img_alt = img.alt;this.current_img_title = img.title">
                            select
                        </button>
                    </div>
                </div>
            </div>
            <div class="pagination w-100 d-flex gap-2 justify-content-center mt-3" v-if="last_page > 1">
                <div v-for="page_num in last_page" :key="page_num" >
                    <label :for="`page_num_${page_num}`" class="btn btn-primary" :class="page_num == page ? 'active' : ''">@{{ page_num }}</label>
                    <input type="radio" class="d-none" name="page_num" :id="`page_num_${page_num}`" v-model="page" :value="page_num" @change="!search ? getImages() : getSearchImages(this.search)">
                </div>
            </div>
            <h1 v-if="images && !images.length && !search">There is not any image yet! (upload now)</h1>
            <div class="foot" style="display: flex;width: 100%;justify-content: space-between;gap: 1rem;">
                <button class="btn btn-primary" @click="this.showUploadPopUp = true">Upload Image</button>
                <div class="hide-content" v-if="showUploadPopUp"></div>
                <div class="pop-up card p-3" v-if="showUploadPopUp">
                    <label for="image" class="mb-2">Choose Image File</label>
                    <input type="file" name="image" id="image" class="form-control mb-4" @change="imageChanges">
                    <div class="d-flex gap-2 w-100 justify-content-center">
                        <button class="btn btn-light"  @click="this.showUploadPopUp = false">Cancel</button>
                        <button class="btn btn-secondary" @click="uploadImage(image)">
                            Add Image
                        </button>
                    </div>
                </div>
                <div class="hide-content" v-if="showSettingsPopUp"></div>
                <div class="pop-up card p-3" v-if="showSettingsPopUp">
                    <h2 class="mb-3 text-center">Edit Image Seo</h2>
                    <div class="img">
                        <img :src="`images/uploads/${img_for_seo.path}`" alt="">
                    </div>
                    <div class="form-group mb-2">
                        <label for="title">Image Title</label>
                        <input type="text" name="title" id="title" class="form-control" v-model="img_for_seo_title">
                    </div>
                    <div class="form-group mb-2">
                        <label for="alt">Image Alt</label>
                        <input type="text" name="alt" id="alt" class="form-control" v-model="img_for_seo_alt">
                    </div>
                    <div class="d-flex gap-2 w-100 justify-content-center">
                        <button class="btn btn-light"  @click="this.showSettingsPopUp = false">Cancel</button>
                        <button class="btn btn-secondary" @click="updateImage()">
                            Update Image
                        </button>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-light"  @click="this.showImages = false; this.search = null;this.forSlider = false">Cancel</button>
                    <button class="btn btn-success"  @click="choose(this.current_img, this.current_img_alt, this.current_img_title);showImages = false">Choose</button>
                </div>
            </div>
        </div> 
        
        {{-- on choose --}}
        <div class="choosed_img" v-html="choosed_img"></div>
      </div>
    </div>
  </div>
  <script src="{{ asset('/libs/vue.js') }}"></script>
  <script src="{{ asset('/libs/jquery.js') }}"></script>
  <script src="{{ asset('/libs/axios.js') }}"></script>
  <script>
    const { createApp, ref } = Vue;
    
    createApp({
      data() {
        return {
          images: null,
          showImages: false,
          showUploadPopUp: false,
          showSettingsPopUp: false,
          image: null,
          current_img: null,
          choosed_img: null,
          search: null,
          page: 1,
          total: 0,
          last_page: 0,
          img_for_seo: null,
          img_for_seo_title: null,
          img_for_seo_alt: null,
        }
      },
      methods: {
        async getImages() {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.get(`{{ route('lib.getImages') }}?page=${this.page}`
                );
                if (response.data.status === true) {
                    $('.loader').fadeOut()
                    this.images = response.data.data.data
                    this.total = response.data.data.total
                    this.last_page = response.data.data.last_page
                } else {
                    $('.loader').fadeOut()
                    document.getElementById('errors').innerHTML = ''
                    $.each(response.data.errors, function (key, value) {
                        let error = document.createElement('div')
                        error.classList = 'error'
                        error.innerHTML = value
                        document.getElementById('errors').append(error)
                    });
                    $('#errors').fadeIn('slow')
                    setTimeout(() => {
                        $('input').css('outline', 'none')
                        $('#errors').fadeOut('slow')
                    }, 5000);
                }
    
            } catch (error) {
                document.getElementById('errors').innerHTML = ''
                let err = document.createElement('div')
                err.classList = 'error'
                err.innerHTML = 'server error try again later'
                document.getElementById('errors').append(err)
                $('#errors').fadeIn('slow')
                $('.loader').fadeOut()
                this.languages_data = false
                setTimeout(() => {
                    $('#errors').fadeOut('slow')
                }, 3500);
    
                console.error(error);
            }
        },
        async getSearchImages(search_words) {
            try {
                const response = await axios.post(`{{ route('lib.images.search')}}?page=${this.page}`, {
                    search_words: search_words,
                },
                );
                if (response.data.status === true) {
                    this.images = response.data.data.data
                    this.total = response.data.data.total
                    this.last_page = response.data.data.last_page
                } else {
                    document.getElementById('errors').innerHTML = ''
                    $.each(response.data.errors, function (key, value) {
                        let error = document.createElement('div')
                        error.classList = 'error'
                        error.innerHTML = value
                        document.getElementById('errors').append(error)
                    });
                    $('#errors').fadeIn('slow')
                    setTimeout(() => {
                        $('input').css('outline', 'none')
                        $('#errors').fadeOut('slow')
                    }, 5000);
                }
    
            } catch (error) {
                document.getElementById('errors').innerHTML = ''
                let err = document.createElement('div')
                err.classList = 'error'
                err.innerHTML = 'server error try again later'
                document.getElementById('errors').append(err)
                $('#errors').fadeIn('slow')
                $('.loader').fadeOut()
                this.languages_data = false
                setTimeout(() => {
                    $('#errors').fadeOut('slow')
                }, 3500);
    
                console.error(error);
            }
        },
        async uploadImage(image) {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.post(`{{ route('lib.image.uploade') }}`, {
                    img: image,
                },
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
    
                );
                if (response.data.status === true) {
                    document.getElementById('errors').innerHTML = ''
                    let error = document.createElement('div')
                    error.classList = 'success'
                    error.innerHTML = response.data.message
                    document.getElementById('errors').append(error)
                    $('#errors').fadeIn('slow')
                    $('.loader').fadeOut()
                    this.showUploadPopUp = false;
                    this.showImages = false;
                    this.getImages()
                    setTimeout(() => {
                        this.showImages = true;
                        $('#errors').fadeOut('slow')
                    }, 3000);
                } else {
                    $('.loader').fadeOut()
                    document.getElementById('errors').innerHTML = ''
                    $.each(response.data.errors, function (key, value) {
                        let error = document.createElement('div')
                        error.classList = 'error'
                        error.innerHTML = value
                        document.getElementById('errors').append(error)
                    });
                    $('#errors').fadeIn('slow')
                    setTimeout(() => {
                        $('input').css('outline', 'none')
                        $('#errors').fadeOut('slow')
                    }, 5000);
                }
    
            } catch (error) {
                document.getElementById('errors').innerHTML = ''
                let err = document.createElement('div')
                err.classList = 'error'
                err.innerHTML = 'server error try again later'
                document.getElementById('errors').append(err)
                $('#errors').fadeIn('slow')
                $('.loader').fadeOut()
                this.languages_data = false
                setTimeout(() => {
                    $('#errors').fadeOut('slow')
                }, 3500);
    
                console.error(error);
            }
        },
        async updateImage(image) {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.post(`{{ route('image.put.seo') }}`, {
                    img_id: this.img_for_seo.id,
                    title: this.img_for_seo_title,
                    alt: this.img_for_seo_alt,
                },
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
    
                );
                if (response.data.status === true) {
                    document.getElementById('errors').innerHTML = ''
                    let error = document.createElement('div')
                    error.classList = 'success'
                    error.innerHTML = response.data.message
                    document.getElementById('errors').append(error)
                    $('#errors').fadeIn('slow')
                    $('.loader').fadeOut()
                    this.showUploadPopUp = false;
                    this.showImages = false;
                    this.getImages()
                    setTimeout(() => {
                        this.showImages = true;
                        $('#errors').fadeOut('slow')
                    }, 3000);
                } else {
                    $('.loader').fadeOut()
                    document.getElementById('errors').innerHTML = ''
                    $.each(response.data.errors, function (key, value) {
                        let error = document.createElement('div')
                        error.classList = 'error'
                        error.innerHTML = value
                        document.getElementById('errors').append(error)
                    });
                    $('#errors').fadeIn('slow')
                    setTimeout(() => {
                        $('input').css('outline', 'none')
                        $('#errors').fadeOut('slow')
                    }, 5000);
                }
    
            } catch (error) {
                document.getElementById('errors').innerHTML = ''
                let err = document.createElement('div')
                err.classList = 'error'
                err.innerHTML = 'server error try again later'
                document.getElementById('errors').append(err)
                $('#errors').fadeIn('slow')
                $('.loader').fadeOut()
                this.languages_data = false
                setTimeout(() => {
                    $('#errors').fadeOut('slow')
                }, 3500);
    
                console.error(error);
            }
        },
        insertSliderContent(element) {
            if (this.slider_imgs.length > 3) {
                // Get the target element where you want to insert the content
                var targetElement = document.getElementById(element);
                
                // Get the content from the 'slider' element
                var sliderContent = document.getElementById('slider').innerHTML;
                document.getElementById(element).focus();
                document.execCommand('insertHTML', false, sliderContent);
                this.showSliderPopUp = false;
                this.slider_imgs = []
                this.setValuesToNull()
            } else {
                $("#errors").fadeIn("slow");
                document.getElementById("errors").innerHTML = "";
                let error = document.createElement("div");
                error.classList = "error";
                error.innerHTML =
                    "يجب ان يحتوي الاسلايدر علي اربعة صور ع الاقل";
                document.getElementById("errors").append(error);
                setTimeout(() => {
                    $("#errors").fadeOut("slow");
                }, 2000);
            }
        },
        insertAlbumContent(element) {
            if (this.album_imgs.length > 2) {
                // Get the target element where you want to insert the content
                var targetElement = document.getElementById(element);
                
                // Get the content from the 'slider' element
                var sliderContent = document.getElementById('album').innerHTML;
                document.getElementById(element).focus();
                document.execCommand('insertHTML', false, sliderContent);
                this.showAlbumPopUp = false;
                this.album_imgs = []
                this.setValuesToNull()
            } else {
                $("#errors").fadeIn("slow");
                document.getElementById("errors").innerHTML = "";
                let error = document.createElement("div");
                error.classList = "error";
                error.innerHTML =
                    "يجب ان يحتوي الالبوم علي تلاثة صور ع الاقل";
                document.getElementById("errors").append(error);
                setTimeout(() => {
                    $("#errors").fadeOut("slow");
                }, 2000);
            }
        },
        choose(src, alt, title) {
            this.choosed_img = `<img src='${src}' alt='${alt}' title='${title}' />`
        },
        photoChanges(event) {
            this.thumbnail = event.target.files[0];
            var file = event.target.files[0];
            var fileType = file.type;
            var validImageTypes = ["image/gif", "image/jpeg", "image/jpg", "image/png"];
            if ($.inArray(fileType, validImageTypes) < 0) {
                document.getElementById("errors").innerHTML = "";
                let error = document.createElement("div");
                error.classList = "error";
                error.innerHTML =
                    "Invalid file type. Please choose a GIF, JPEG, or PNG image.";
                document.getElementById("errors").append(error);
                $("#errors").fadeIn("slow");
                setTimeout(() => {
                    $("#errors").fadeOut("slow");
                }, 2000);
    
                $(this).val(null);
                $("#preview").attr(
                    "src",
                    "/Moheb/images/add_image.svg"
                );
                $(".photo_group i").removeClass("fa-edit").addClass("fa-plus");
            } else {
                // display image preview
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#preview").attr("src", e.target.result);
                    $(".photo_group  i")
                        .removeClass("fa-plus")
                        .addClass("fa-edit");
                    $(".photo_group label >i").fadeOut("fast");
                };
                reader.readAsDataURL(file);
            }
        },
        imageChanges(event) {
            this.image = event.target.files[0];
                    // check if file is valid image
            var file = event.target.files[0];
            var fileType = file.type;
            var validImageTypes = ["image/gif", "image/jpeg", "image/jpg", "image/png"];
            if ($.inArray(fileType, validImageTypes) < 0) {
                document.getElementById("errors").innerHTML = "";
                let error = document.createElement("div");
                error.classList = "error";
                error.innerHTML =
                    "Invalid file type. Please choose a GIF, JPEG, or PNG image.";
                document.getElementById("errors").append(error);
                setTimeout(() => {
                    $("#errors").fadeOut("slow");
                }, 2000);
    
                $(this).val(null);
            } else {
                // display image preview
                var reader = new FileReader();
                reader.onload = function (e) {
                };
                reader.readAsDataURL(file);
            }
    
        },
      },
      created() {
        this.getImages()
      },
      mounted() {
        $(document).on('click', '.imgs .img', function () {
            $(this).css('border', '2px solid #13DEB9')
            $(this).siblings().css('border', 'none')
        })
      },
    }).mount('#images_wrapper')
    </script>
</body>

</html>