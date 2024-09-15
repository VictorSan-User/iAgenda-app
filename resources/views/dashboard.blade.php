<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 flex-content">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <head>
                    <meta charset="UTF-8" />
                    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

                 
                    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

                    </head>

                    <body>
                    <div id="container">
                        <div id="header">
                            <div id="monthDisplay"></div>

                            <div>
                            <button id="backButton"><</button>
                            <button id="nextButton">></button>
                            </div>
                            
                        </div>

                        <div id="weekdays">
                            <div>Domingo</div>
                            <div>Segunda</div>
                            <div>Terça</div>
                            <div>Quarta</div>
                            <div>Quinta</div>
                            <div>Sexta</div>
                            <div>Sábado</div>
                        </div>


                      
                        <div id="calendar" ></div>

                    
                    </div>

                    <div id="newEventModal" class="text-black-900 bg-slate-700">
                        <h2><strong>Novo Evento</strong></h2>
                    
                        <input id="eventTitleInput" placeholder="Título" />
                        <input id="eventStartTimeInput" type="time" placeholder="Hora de Início" />
                        <input id="eventEndTimeInput" type="time" placeholder="Hora de Fim" />
                    
                        <button id="saveButton">Salvar</button>
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
