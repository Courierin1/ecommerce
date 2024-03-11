@extends('layout.site.app')
@section('title', 'Party')

@section('content')

<!-- consult sec -->
<section class="consult-sec py-5" id="consultant">
    <div class="container">
        <h2 class="text-center">Become a Consultant Today!</h2>
    
        <div class="row setup">
            <div class="col-xs-6 col-md-6 col-12">
                    <div class="col-md-12">
                        <h3>SEARCH FOR A CONSULTANT</h3>

                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#zip-code" role="tab"
                                    aria-controls="pills-zip-code" aria-selected="true">Zip Code</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#consultant-name" role="tab"
                                    aria-controls="pills-consultant-name" aria-selected="false">Consultant Name</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#rep-number" role="tab"
                                    aria-controls="pills-rep-number" aria-selected="false">Consultant Number</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3">
                            <div class="tab-pane fade show active" id="zip-code" role="tabpanel"
                                aria-labelledby="zip-code-tab">
                                <label for="">Zip Code</label>
                                <input type="text" class="form-control" name="zipcode" id="zipcode">
                                <a href="javascript:;" onclick="getZipCode();"
                                    class="btn btn-primary btn-lg pull-right mt-2">Search</a>
                            </div>
                            <div class="tab-pane fade" id="consultant-name" role="tabpanel"
                                aria-labelledby="consultant-name-tab">
                                <div class="form-grpup">
                                    <label for="">Full Name</label>
                                    <input type="text" class="form-control" name="fullname" id="fullname">
                                    <a href="javascript:;" onclick="getFullName();"
                                        class="btn btn-primary btn-lg pull-right mt-2">Search</a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="rep-number" role="tabpanel" aria-labelledby="rep-number-tab">
                                <div class="form-grpup">
                                    <label for="">Rep Number</label>
                                    <input type="number" class="form-control" name="repnumber" id="repnumber">
                                    <a href="javascript:;" onclick="getRepNum();"
                                        class="btn btn-primary btn-lg pull-right mt-2">Search</a>
                                </div>
                            </div>
                        </div>
                    </div>
               

            </div>
               
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="myContainer">
                    <div class="form-container animated">
                        <h4 class="text-center form-title mb-0">THESE ARE CONSULTANTS IN YOUR AREA
                        </h4>
                        <div class="row" id="all_consultant">

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="consultant-image">
                                    <div class="modal-content-wrapper" id="consult">
                                        <!-- <div class="image-modal-content">
                                            <img src="images/app-286487-v6.png.100x100_q85_crop_upscale.png"
                                                data-title="Rosalinda Molina" data-description="" data-url=""
                                                data-repo="" alt="">
                                        </div> -->

                                    </div>
                                    <!-- modal popup (displayed none by default) -->
                                    <div class="image-modal-popup">
                                        <div class="wrapper">
                                            <span>&times;</span>
                                            <img src="" alt="Image Modal">
                                            <div class="description">
                                                <h4></h4>
                                                <p></p>
                                                <p class=""><a id="mail" href="mailto:"></a>
                                                </p>
                                                <input type="text" hidden name="choose_consultant_id"
                                                    id="choose_consultant_id" value="" />
                                                <!-- nextBtn -->
                                                <button class="btn btn-primary nextBtn btn-lg" id=""
                                                    onclick="chooseConsultant();" type="button">Choose
                                                    this Consultant</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        
        
</section>

@endsection
@section('afterScript')
<script src="{{ asset('js/forms.js') }}"></script>

<script>
    var dataObject = {};

    function getZipCode() {
        dataObject = {};
        let zipCode = parseInt($("#zipcode").val())
        if (!isNaN(zipCode)) {
            dataObject['zipcode'] = zipCode;
        } else {
            errortoast("Please enter a valid zip code to find the consultant.");
            return false;
        }
        fetchData(dataObject)
    }

    function getFullName() {
        dataObject = {};
        let name = $("#fullname").val();
        if (name != "") {
            dataObject['name'] = name;
        } else {
            errortoast("Please enter a valid name to find the consultant.");
            return false;
        }
        fetchData(dataObject)
    }

    function getRepNum() {
        dataObject = {};
        let rep = parseInt($("#repnumber").val())
        if (!isNaN(rep)) {
            dataObject['rep'] = rep;
        } else {
            errortoast("Please enter a valid rep number to find the consultant.");
            return false;
        }
        fetchData(dataObject)
    }

    function chooseConsultant() {

        $.ajax({
            url: "{{ route('add.consultant') }}",
            method: "POST",
            data: {
                id: $('#choose_consultant_id').val(),
                _token: "{{ csrf_token() }}",

            },
            success: function (data) {
                if (data.status == 1) {

                    $('.spn-name').html(
                        data.consultant);

                        successtoast(data.message);
                } else {
                    errortoast('something went wrong');
                }
            },
            error: function (error) {
                errortoast('something went wrong');

            }
        });
    }

    function fetchData(object) {


        $.ajax({
            url: "/find",
            method: "POST",
            data: {
                req: object,
                _token: "{{ csrf_token() }}",

            },
            success: function (data) {
                var response = JSON.parse(data)
                console.log(response)
                if (response.length > 0) {
                    var html = '';
                    response.forEach(element => {
                        if(element.image!=null){
                        html += `
                            <div class="image-modal-content">
                                <img src="${element.image}"
                                    data-title="${element.name}" data-description="" data-url="${element.email}"
                                    data-id="${element.id}" alt="">
                            </div>
                            `;
                        }
                        else{
                            html += `
                            <div class="image-modal-content">
                                <img src="/images/shellie-logo.jpg"
                                    data-title="${element.name}" data-description="" data-url="${element.email}"
                                    data-id="${element.id}" alt="">
                            </div>
                            `;
                        }
                    });
                    $(`#consult`).html(html);

                    // Consultant Modal
                    // all images inside the image modal content class
                    const lightboxImages = document.querySelectorAll('.image-modal-content img');

                    // dynamically selects all elements inside modal popup
                    const modalElement = element =>
                        document.querySelector(`.image-modal-popup ${element}`);

                    const body = document.querySelector('body');

                    // closes modal on clicking anywhere and adds overflow back
                    document.addEventListener('click', () => {
                        body.style.overflow = 'auto';
                        modalPopup.style.display = 'none';
                    });

                    const modalPopup = document.querySelector('.image-modal-popup');

                    // loops over each modal content img and adds click event functionality
                    lightboxImages.forEach(img => {
                        const data = img.dataset;
                        img.addEventListener('click', e => {
                            body.style.overflow = 'hidden';
                            e.stopPropagation();
                            console.log(data.id)
                            modalPopup.style.display = 'block';
                            modalElement('h4').innerHTML = data.title;
                            modalElement('p').innerHTML = data.description;
                            modalElement('#mail').textContent = data.url;
                            modalElement('#mail').href = "mailto:" + data.url;
                            modalElement('img').src = img.src;
                            $('input#choose_consultant_id').val(data.id)
                        });
                    });
                    
                }
            },
            error: function (error) {
                $(`#consult`).html(`
                <div class="alert alert-warning">
                    <strong>Darn.</strong> Doesn't look like your search resulted any matches. You can
                    change your search fields or try a different search.
                </div>
                `);

            }
        });
    }
    </script>
    @endsection