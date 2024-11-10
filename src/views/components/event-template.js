$(document).ready(function () {
    $('#loadEventsSpinner').show()
    refreshEvents();
});

function refreshEvents() {
    apiGetEvents((response) => {
        renderTimeline(response.result);
        renderEvents(response.result);
    }, () => $('#loadEventsSpinner').hide())
}

events = [];

function renderEvents(eventsWithPositions) {
    $('#events-column').empty();

    const eventTemplate = document.getElementById("event-template");

    events = [];

    eventsWithPositions.forEach(eventWithPosition => {
        event = eventWithPosition.event;
        events.push(event);

        const clone = eventTemplate.content.cloneNode(true);
        const eventDiv = clone.querySelector('.event');
        eventDiv.id = `event-${event.id}`;

        eventDiv.style = `grid-row: ${eventWithPosition.rowStartPosition} / ${eventWithPosition.rowEndPosition}; background-color: ${event.categoryColor};`;
        eventDiv.querySelector('.title').textContent = event.title;
        eventDiv.querySelector('.start').textContent = event.start;
        eventDiv.querySelector('.end').textContent = event.end;
        eventDiv.querySelector('#eventPicture').setAttribute('src', event.picture);

        eventDiv.setAttribute('data-title', event.title);
        eventDiv.setAttribute('data-start', event.start);
        eventDiv.setAttribute('data-end', event.end);
        eventDiv.setAttribute('data-description', event.description);
        eventDiv.setAttribute('data-picture', event.picture);
        eventDiv.setAttribute('data-categoryName', event.categoryName);
        eventDiv.setAttribute('data-categoryColor', event.categoryColor);

        eventDiv.addEventListener("click", openDetailsModal);

        const editButton = eventDiv.querySelector('#edit-button')
        editButton.setAttribute('data-id', event.id);
        editButton.addEventListener('click', openEditEventDetailsModal);

        const deleteButton = eventDiv.querySelector('#delete-button');
        deleteButton.setAttribute('data-id', event.id);
        deleteButton.setAttribute('data-title', event.title);
        deleteButton.addEventListener('click', openDeleteModal);


        $('#events-column').append(eventDiv);
    });
}

function renderTimeline(eventsWithPositions) {
    $('#timeline-column').empty();

    const uniqueeventsWithPositions = new Map(eventsWithPositions.map(eventsWithPosition => [eventsWithPosition.event.start, eventsWithPosition.rowStartPosition]));

    for (let [startTimestamp, rowPosition] of uniqueeventsWithPositions) {
        const timelineDiv =
            `<div class="timeline-timestamp" style="grid-row: ${rowPosition} / ${rowPosition}">
                                &#x2022;${startTimestamp}
                            </div>`;

        $('#timeline-column').append(timelineDiv);
    }
}