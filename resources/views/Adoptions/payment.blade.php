<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mishi Pago</title>
    <script src="https://js.stripe.com/v3/"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .method-payment img, .payment-logo {
            width: 50px;
            margin: 0 10px;
            transition: transform 0.3s ease;
        }
        .method-payment img:hover, .payment-logo:hover {
            transform: scale(1.2);
        }
        .note {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .shelter-img {
            display: block;
            margin: 0 auto;
            max-width: 250px;
            height: auto;
        }
        .shelter-name {
            color: red;
        }
        .payment-methods {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .payment-option {
            display: flex;
            align-items: center;
            width: 30%;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .error-message {
            color: red;
            font-size: 0.85rem;
            margin-top: 5px;
        }
        /* Cambia la altura de la barra de progreso */
        .progress {
            height: 40px;
        }
        .progress-bar {
            font-size: 1.2rem;
            font-weight: bold;
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            .payment-option {
                width: 45%; /* Ajusta el ancho para pantallas medianas */
            }
            .shelter-img {
                max-width: 200px;
            }
            .note {
                font-size: 0.8rem; /* Reduce el tamaño de fuente de las notas */
            }
            .progress {
                height: 30px; /* Reduce la altura de la barra de progreso */
            }
            .progress-bar {
                font-size: 1rem;
            }
        }
        @media (max-width: 480px) {
            .payment-methods {
                flex-direction: column; /* Cambia a columna en pantallas pequeñas */
                align-items: center;
            }
            .payment-option {
                width: 100%; /* Ocupa todo el ancho en pantallas pequeñas */
                margin-bottom: 8px;
            }
            .shelter-img {
                max-width: 150px;
            }
            .method-payment img, .payment-logo {
                width: 40px; /* Ajusta el tamaño de las imágenes de pago */
                margin: 5px;
            }
            .progress {
                height: 25px; /* Reduce aún más la altura de la barra */
            }
            .progress-bar {
                font-size: 0.9rem;
            }
            .note {
                font-size: 0.75rem;
            }
        }
    </style>    
</head>
<body>
    <!-- Alert messages for session states -->
    @if (session('danger'))
        <div class="alert alert-danger" role="alert">
            {{ session('danger') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Detalles de donación al Refugio <span class="shelter-name">{{ $kitten->shelter->nombre }}</span></h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Dirección:</strong> {{ $kitten->shelter->direccion }}</p>
                        <p><strong>Contacto:</strong> {{ $kitten->shelter->telefono }}</p>

                        <!-- Display shelter image or default image -->
                        @if ($kitten->shelter->foto)
                            <img src="{{ asset('storage/shelters/' . $kitten->shelter->foto) }}" alt="{{ $kitten->shelter->nombre }}" class="rounded-circle img-fluid mb-3 shelter-img">
                        @else
                            <img src="{{ asset('img/icono_refugio.png') }}" alt="Foto por defecto" class="rounded-circle img-fluid mb-3 shelter-img">
                        @endif

                        <!-- Payment form -->
                        <form action="{{ route('dashboard.pay', $kitten->shelter) }}" method="POST" id="payment-form">
                            @csrf
                            <div class="form-group">
                                <label for="amount">Monto a Donar <strong>(MX)</strong>:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" id="amount" name="amount" class="form-control" min="10" max="10000" required>
                                </div>
                                <small class="note">Puedes donar desde $10 pesos hasta $10,000 por transacción. (MX)</small>
                                @if ($errors->has('amount'))
                                    <div class="alert alert-danger mt-5">
                                        {{ $errors->first('amount') }}
                                    </div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label><strong>Método de Pago:</strong></label>
                                    <div class="payment-methods">
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="Visa" required>
                                            <i class="fab fa-cc-visa payment-logo" style="font-size: 2rem; color: #1a1f71;"></i> <strong>Visa</strong>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="MasterCard" required>
                                            <i class="fab fa-cc-mastercard payment-logo" style="font-size: 2rem; color: #ff5f00;"></i> <strong>MasterCard</strong>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="American Express" required>
                                            <i class="fab fa-cc-amex payment-logo" style="font-size: 2rem; color: #1071b2;"></i> <strong>American Express</strong>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="PayPal" required>
                                            <i class="fab fa-cc-paypal payment-logo" style="font-size: 2rem; color: #003087;"></i> <strong>PayPal</strong>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="Google Pay" required>
                                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v5/icons/googlepay.svg" alt="Google Pay" class="payment-logo" style="width: 50px; height: auto;"> <strong>Google Pay</strong>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="Apple Pay" required>
                                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v5/icons/applepay.svg" alt="Apple Pay" class="payment-logo" style="width: 50px; height: auto;"> <strong>Apple Pay</strong>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="Samsung Pay" required>
                                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v5/icons/samsungpay.svg" alt="Samsung Pay" class="payment-logo" style="width: 50px; height: auto;"> <strong>Samsung Pay</strong>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="Stripe" required>
                                            <i class="fab fa-cc-stripe payment-logo" style="font-size: 2rem; color: #394196;"></i> <strong>Stripe</strong>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="Discover" required>
                                            <i class="fab fa-cc-discover payment-logo" style="font-size: 2rem; color: #ff6000;"></i> <strong>Discover</strong>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="Diners Club" required>
                                            <i class="fab fa-cc-diners-club payment-logo" style="font-size: 2rem; color: #0073a8;"></i> <strong>Diners Club</strong>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="JCB" required>
                                            <i class="fab fa-cc-jcb payment-logo" style="font-size: 2rem; color: #0069aa;"></i> <strong>JCB</strong>
                                        </label>
                                    </div>
                                @if ($errors->has('payment_method'))
                                    <div class="alert alert-danger mt-2">
                                        {{ $errors->first('payment_method') }}
                                    </div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="card-element"><strong>Tarjeta de Crédito/Débito:</strong></label>
                                <div id="card-element"></div>
                                <div id="card-errors" role="alert" class="error-message mt-2"></div>
                                @if ($errors->has('stripeToken'))
                                    <div class="alert alert-danger mt-2">
                                        {{ $errors->first('stripeToken') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Progress bar for payment process -->
                            <div class="progress mt-4 d-none" id="progress-container">
                                <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                            
                            <button type="button" id="pay-button" class="btn btn-success btn-block">Pagar</button>
                            <a href="{{ route('dashboard.index') }}" class="btn btn-secondary btn-block mt-2">Volver a MishiVet</a>
                        </form>
                        <p class="note mt-3">Al hacer clic en "Pagar", aceptas los <a href="#">términos y condiciones</a> de nuestra plataforma MishiVet disponibles próximamente online.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();
        const style = {
            base: {
                color: "#32325d",
                fontFamily: "'Helvetica Neue', Helvetica, sans-serif",
                fontSmoothing: "antialiased",
                fontSize: "16px",
                lineHeight: "24px",
                '::placeholder': { color: '#aab7c4' }
            },
            invalid: { color: '#fa755a', iconColor: '#fa755a' }
        };
        const cardElement = elements.create('card', { style: style });
        cardElement.mount('#card-element');
    
        const form = document.getElementById('payment-form');
        const payButton = document.getElementById('pay-button');
        const progressBar = document.getElementById('progress-bar');
        const progressContainer = document.getElementById('progress-container');
    
        payButton.addEventListener('click', async (event) => {
            event.preventDefault();
            payButton.classList.add('d-none');
            progressContainer.classList.remove('d-none');
    
            let progress = 0;
            const interval = setInterval(() => {
                progress += 3;
                progressBar.style.width = `${progress}%`;
                progressBar.setAttribute('aria-valuenow', progress);
                
                // Cambia el texto a "Pago validado" cuando alcanza el 100%
                if (progress >= 100) {
                    progressBar.innerHTML = "¡Mishi pago exitoso!";
                    clearInterval(interval);
                    
                    // Espera 2 segundos antes de enviar el formulario
                    setTimeout(() => {
                        form.submit();
                    }, 2000);
                } else {
                    progressBar.innerHTML = `${progress}%`;
                }
            }, 100);
    
            const { token, error } = await stripe.createToken(cardElement);
            if (error) {
                clearInterval(interval);
                progressContainer.classList.add('d-none');
                payButton.classList.remove('d-none');
                document.getElementById('card-errors').textContent = error.message;
            } else {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
            }
        });
    </script>
</body>
</html>
