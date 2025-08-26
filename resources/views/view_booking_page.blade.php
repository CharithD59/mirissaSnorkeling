@include('header')

<!-- Page Header Start -->
<div class="container-fluid page-header_booking">
    <h1 class="display-3 text-uppercase text-white mb-3">Online Booking</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="/">HOME</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0">Booking</h6>
    </div>
</div>
<!-- Page Header Start -->

<!-- Tour Booking Start -->
<div class="container-fluid booking py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h5 class="section-booking-title pe-3">Booking</h5>
                <h1 class="text-white mb-4">Online Booking</h1>
                <p class="text-white mb-4">Easily book your diving, snorkeling, or blue whale tour online and secure your spot for an unforgettable adventure in Mirissa Bay.
                </p>
                <p class="text-white mb-4">Our user-friendly platform ensures a seamless booking process, so you can focus on planning your dream ocean experience.
                </p>
                <!-- <a href="#" class="btn btn-light text-primary rounded-pill py-3 px-5 mt-2">Read More</a> -->
            </div>
            <div class="col-lg-6">
                <h1 class="text-white mb-3">Book A Mirissa Bay Diving</h1>
                <p class="text-white mb-4"> <span class="text-warning">Exclusive Discounts:</span>  
                    Book now and enjoy special deals on our diving, snorkeling, and blue whale tours. Get more exciting offers here and make your Mirissa Bay adventure unforgettable!</p>
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control bg-white border-0" id="name"
                                    placeholder="Your Name">
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control bg-white border-0" id="email"
                                    placeholder="Your Email">
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control bg-white border-0" id="contact_no"
                                    placeholder="Your Contact No">
                                <label for="contact_no">Contact No</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating date" id="date3" data-target-input="nearest">
                                <input type="date" class="form-control bg-white border-0" id="datetime"
                                    placeholder="Date & Time" data-target="#date3" data-toggle="datetimepicker" />
                                <label for="datetime">Date & Time</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="SelectPerson">
                                    <option value="Persons 1">Persons 1</option>
                                    <option value="Persons 2">Persons 2</option>
                                    <option value="Persons 3">Persons 3</option>
                                    <option value="Persons 4">Persons 4</option>
                                    <option value="Persons 5">Persons 5</option>
                                    <option value="Persons 5 Plus">Persons 5 +</option>
                                </select>
                                <label for="SelectPerson">Persons</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="SelectKids">
                                    <option value="0">Kids 0</option>
                                    <option value="1">Kids 1</option>
                                    <option value="2">Kids 2</option>
                                    <option value="3">Kids 3</option>
                                    <option value="4">Kids 4</option>
                                    <option value="5">Kids 5</option>
                                    <option value="6">Kids 5 +</option>
                                </select>
                                <label for="CategoriesSelect">Kids</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="selectServices">
                                    <option value="Blue Whale Watching">Blue Whale Watching</option>
                                    <option value="Blue Whale Snorkeling">Blue Whale Snorkeling</option>
                                    <option value="Dolpin Snorkeling">Dolpin Snorkeling</option>
                                    <option value="Turtle Snorkeling Shallow Water">Turtle Snorkeling Shallow Water</option>
                                    <option value="Free diving">Free diving</option>
                                    <option value="Deep Sea Fishing Tour">Deep Sea Fishing Tour</option>
                                    <option value="Discovery scuba diving DSD">Discovery scuba diving DSD</option>
                                    <option value="Front Diving">Front Diving</option>
                                    <option value="Reef Diving">Reef Diving</option>
                                </select>
                                <label for="select1">Services</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control bg-white border-0" placeholder="Special Request"
                                    id="message" style="height: 100px"></textarea>
                                <label for="message">Special Request</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary text-white w-100 py-3" onclick="saveBooking_page();" id="bookingBtn" value="S E N D  B O O K I N G" type="button">Book Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Tour Booking End -->


<script>

function saveBooking_page() {

    document.getElementById('bookingBtn').value = 'required';

    const name           = document.getElementById('name').value;
    const email          = document.getElementById('email').value;
    const datetime       = document.getElementById('datetime').value;
    const selectServices = document.getElementById('selectServices').value;
    const SelectPerson   = document.getElementById('SelectPerson').value;
    const SelectKids     = document.getElementById('SelectKids').value;
    const message        = document.getElementById('message').value;
    const contact_no        = document.getElementById('contact_no').value;

    if(name == "" || email == "" || datetime == "" || selectServices == "" || SelectPerson == "" || SelectKids == "" || message == "" || contact_no == ""){

        Swal.fire({
                        position: 'center',
                        imageUrl: '{{"public/img/logo.png"}}',
                        imageHeight: 60,
                        imageAlt: 'logo',
                        color: '#121518',
                        text: 'Please complete all required fields',
                        showConfirmButton: true,
                        confirmButtonColor: '#fdbe33',
                        timer: 3000
                    }).then((result) => {

                    })

    }else{

        document.getElementById('bookingBtn').value = 'Sending…';

        $.ajax({

            url: 'send_booking_mail',
            type: 'GET',
            data: {
                name: name,
                email: email,
                datetime: datetime,
                selectServices: selectServices,
                SelectPerson: SelectPerson,
                SelectKids: SelectKids,
                message: message,
                contact_no: contact_no,
            },
            success: function (response) {

                if(response === 'success'){

                    document.getElementById('bookingBtn').value = 'Booked';

                    Swal.fire({
                        position: 'center',
                        imageUrl: '{{"public/img/logo.png"}}',
                        imageHeight: 60,
                        imageAlt: 'logo',
                        color: '#121518',
                        text: 'Thank you for getting in touch! We appreciate you contacting us',
                        showConfirmButton: false,
                        timer: 2500
                    }).then((result) => {
                        window.location.href = 'view_booking_page';
                    })
                }else{
                    Swal.fire({
                        position: 'center',
                        imageUrl: '{{"public/img/logo.png"}}',
                        imageHeight: 60,
                        imageAlt: 'logo',
                        color: '#121518',
                        text: 'Oops! Somthing went wrong.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {

                        document.getElementById('name').value = '';
                        document.getElementById('email').value = '';
                        document.getElementById('datetime').value = '';
                        document.getElementById('selectServices').value = '';
                        document.getElementById('SelectPerson').value = '';
                        document.getElementById('SelectKids').value = '';
                        document.getElementById('message').value = '';

                        // window.location.href = 'view_contact_page';
                    })
                }
            }

        })

    }

}

</script>

@include('footer')