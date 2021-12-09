<footer>
    <div class="footer-container">
        <div class="row justify-content-between">
            <div class="col-12 col-md-6 col-lg-4 mt-2">
                <div class="yellow-line"></div>
                <h2 class="yellow">Dream. Travel. Live.</h2>
                <h3 class="yellow">BoolBnB</h3>
                <div class="socials-container justify-content-between d-flex">
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>

            </div>
            <div class="col-12 col-md-6 col-lg-2 mt-2">
                <div class="yellow-line"></div>
                <h4 class="yellow">Host</h4>
                <ul>
                    @if (Auth::check())
                    <li><a href="{{ route('users.apartments.create') }}">Try to host</a></li>
                    <li><a href="#">Improve your visibility</a></li>
                    @else
                    <li><a href="{{ route('register') }}">Try to host</a></li>
                    <li><a href="{{ route('register') }}">Improve your visibility</a></li>
                    @endif
                    <li><a href="#">Rules to host</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg-2 mt-2">
                <div class="yellow-line"></div>
                <h4 class="yellow">Info</h4>
                <ul>
                    <li><a href="#">Centro Assistenza</a></li>
                    <li><a href="#">Our response to the COVID-19 emergency</a></li>
                    <li><a href="#">Opzioni di cancellazione</a></li>
                    <li><a href="#">Informazioni di sicurezza</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg-2 mt-2">
                <div class="yellow-line"></div>
                <h4 class="yellow">Contacts</h4>
                <ul class="contacts">
                    <li><i class="fas fa-phone"></i>055/123456</li>
                    
                    <li><i class="fab fa-whatsapp"></i>Live chat</li>

                    <li><i class="fas fa-at"></i>bool@bnb.com</li>
                </ul>
            </div>
            
        </div>
    </div>

    <div class="copyright">
        <p class="text-center mt-1 mb-1">© designed by Jose</p>
    </div>

</footer>