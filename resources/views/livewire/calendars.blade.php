@push('style')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' />
@endpush

<div>
    @push('scripts')
        <script type="text/javascript">
            Livewire.on('alert', () => {
                document.querySelectorAll('[data-dismiss-target]').forEach(triggerEl => {
                    const targetEl = document.querySelector(triggerEl.getAttribute('data-dismiss-target'))

                    new Dismiss(targetEl, {
                        triggerEl
                    })
                });
            });
        </script>
    @endpush
    @include('elements.flash')

    <div>
        <div class="grid grid-cols-12 gap-6 overflow-x-auto" id='calendar-container' wire:ignore>
            <div class="col-span-12 xl:col-span-2 p-4" id="events">
                <h2 class="font-bold text-xl">
                    Liste des Evènements
                </h2>
                <div class="divider"></div>

                @foreach(\Selvah\Models\Calendar::EVENTS_TYPES as $key => $value)
                    <button type="button" disabled data-event='{"title":"{{ $value['title'] }}"}' class="dropEvent btn btn-sm font-bold disabled:text-white mb-2 w-full" style="background-color:{{ $value['color'] }};">{{ $value['title'] }}</button>
                @endforeach
            </div>
            <div class="col-span-12 xl:col-span-10 max-h-[900px]" id='calendar'></div>
        </div>
    </div>

    <div>
        <form wire:submit.prevent="save">
            <input type="checkbox" id="createModal" class="modal-toggle" wire:model="showModal" />
            <label for="createModal" class="modal cursor-pointer">
                <label class="modal-box relative">
                    <label for="createModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                    <h3 class="font-bold text-lg">
                        Créer un Evènement
                    </h3>

                    <x-form.select wire:model="type"  label="Type de maintenance">
                        <option value="" disabled>Selectionnez le type</option>
                        @foreach(\Selvah\Models\Calendar::EVENTS_TYPES as $key => $value)
                        <option value="{{ $key }}" style="color:{{$value['color']}}; font-weight:bold;">
                            {{$value['title']}}
                        </option>
                        @endforeach
                    </x-form.select>

                    <x-form.text wire:model='model.title' name="title" label="Titre" placeholder="Titre..." />

                    <x-form.checkbox wire:model="model.allDay" name="allDay" label=" Toute la journée ?">
                        Cochez si l'évènement dure toute la journée
                    </x-form.checkbox>

                    <div>
                        @if ($model->allDay == false)
                            @php $message = "Date et heure de commencement de l'évènement.";@endphp
                            <x-form.date wire:model="started_at" name="started_at" label="Début de l'évènement" placeholder="Début..." value="{{ $started_at }}" :info="true" :infoText="$message" />

                            @php $message = "Date et heure de fin de l'évènement.";@endphp
                            <x-form.date wire:model="ended_at" name="ended_at" label="Fin de l'évènement" placeholder="Fin..." value="{{ $ended_at }}" :info="true" :infoText="$message" />
                        @endif
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn btn-success gap-2">
                            Créer
                        </button>
                        <label for="createModal" class="btn btn-neutral">Fermer</label>
                    </div>
                </label>
            </label>
        </form>
    </div>

    <div>
        <form wire:submit.prevent="destroy">
            <input type="checkbox" id="deleteModal" class="modal-toggle" wire:model="showDeleteModal" />
            <label for="deleteModal" class="modal cursor-pointer">
                <label class="modal-box relative">
                    <label for="deleteModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                    <h3 class="font-bold text-lg">
                        Supprimer un Evènement
                    </h3>
                    <div>
                        <p class="my-7 prose">
                            Voulez-vous supprimer l'évènement <code class="bg-[color:var(--tw-prose-pre-bg)] font-bold rounded-sm" style="color:{{ isset($deleteInfo['backgroundColor']) ? $deleteInfo['backgroundColor'] : '' }}">{{ isset($deleteInfo['title']) ? $deleteInfo['title'] : '' }}</code> commencant le <span class="font-bold">{{ isset($deleteInfo['start']) ? \Carbon\Carbon::parse($deleteInfo['start'])->format('d-m-Y H:i') : '' }}</span> ?
                        </p>
                    </div>
                    <div class="modal-action">
                        <button type="submit" class="btn btn-error gap-2">
                            <i class="fa-solid fa-trash-can"></i>
                            Supprimer
                        </button>
                        <label for="deleteModal" class="btn btn-neutral">Fermer</label>
                    </div>
                </label>
            </label>
        </form>
    </div>

</div>

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/locales-all.min.js"></script>
<script>
    document.addEventListener('livewire:load', function () {
        const Calendar = FullCalendar.Calendar;
        const calendarEl = document.getElementById('calendar');
        const calendar = new Calendar(calendarEl, {
            timeZone: 'Europe/Paris',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listMonth'
            },
            locale: '{{ config('app.locale') }}',
            events: JSON.parse(@this.events),

            // Create Event
            selectable: @js(Auth::user()->can('create', \Selvah\Models\Calendar::class)),
            select: arg => {
                Livewire.emit('eventAdd', arg);
            },

            // Move/Resize Event
            editable: @js(Auth::user()->can('update', \Selvah\Models\Calendar::class)),
            eventResize: info => @this.eventChange(info.event),
            eventDrop: info => @this.eventChange(info.event),

            // Delete Event
            eventClick: info => {
                if (@js(Auth::user()->can('delete', \Selvah\Models\Calendar::class))) {
                    Livewire.emit('eventDestroy', info.event);
                }
            }
        });
        calendar.render();

        Livewire.on('evenAddSuccess', event =>  {
            calendar.addEvent({
                id: event.id,
                title: event.title,
                start: event.started,
                end: event.ended,
                color: event.color,
                allDay: event.allDay
            });
        });

        Livewire.on('evenDestroySuccess', id =>  {
            event = calendar.getEventById(id)
            event.remove();
        });
    });
</script>
@endpush
