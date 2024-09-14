<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <head>
                    <meta charset="UTF-8" />
                    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

                 
                    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

                    <title>Calendario</title>
                    </head>

                    <body>
                    <div id="container">
                        <div id="header">
                            <div id="monthDisplay"></div>

                            <div>
                            <button id="backButton">Voltar</button>
                            <button id="nextButton">Próximo</button>
                            </div>
                            
                        </div>

                        <div id="weekdays">
                            <div>Domingo</div>
                            <div>Segunda-feira</div>
                            <div>Terça-feira</div>
                            <div>Quarta-feira</div>
                            <div>Quinta-feira</div>
                            <div>Sexta-feira</div>
                            <div>Sábado</div>
                        </div>


                        <!-- div dinamic -->
                        <div id="calendar" ></div>

                    
                    </div>

                    <div id="newEventModal">
                        <h2>New Evente</h2>

                        <input id="eventTitleInput" placeholder="Event Title"/>

                        <button id="saveButton"> Salvar</button>
                        <button id="cancelButton">Cancelar</button>
                    </div>

                    <div id="deleteEventModal">
                        <h2>Evento</h2>

                        <div id="eventText"></div><br>


                        <button id="deleteButton">Deletar</button>
                        <button id="closeButton">Fechar</button>
                    </div>

                    <div id="modalBackDrop"></div>


                    <script src="{{ asset('js/mainCalendar.js') }}"></script>
                    
                    </body>
                    </html>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
