$(document).ready(function () {
    refreshEvents();
});

function refreshEvents() {
    apiGetEvents((response) => {
        renderTimeline(response.result);
        renderEvents(response.result);
    })
}

function renderEvents(eventsWithPositions) {
    $('#events-column').empty();
    console.log(eventsWithPositions);

    const eventTemplate = document.getElementById("event-template");
    eventsWithPositions.forEach(eventWithPosition => {
        event = eventWithPosition.event;

        const clone = eventTemplate.content.cloneNode(true);
        const eventDiv = clone.querySelector('.event');
        eventDiv.id = `event-${event.id}`;
        eventDiv.style = `grid-row: ${eventWithPosition.rowStartPosition} / ${eventWithPosition.rowEndPosition}`;

        eventDiv.querySelector('.title').textContent = event.title;
        eventDiv.querySelector('.start').textContent = `Start: ${event.start}`;
        eventDiv.querySelector('.end').textContent = `End: ${event.end}`;
        eventDiv.querySelector('.description').textContent = `Description: ${event.description}`;

        eventDiv.setAttribute('data-title', event.title);
        eventDiv.setAttribute('data-start', event.start);
        eventDiv.setAttribute('data-end', event.end);
        eventDiv.setAttribute('data-description', event.description);

        eventDiv.addEventListener("click", openDetailsModal);

        const editButton = eventDiv.querySelector('#edit-button')
        editButton.addEventListener('click', editButtonHandler);

        const deleteButton = eventDiv.querySelector('#delete-button');
        deleteButton.setAttribute('data-id', event.id);
        deleteButton.setAttribute('data-title', event.title);
        deleteButton.addEventListener('click', openDeleteModal);


        $('#events-column').append(eventDiv);
    });
}

function editButtonHandler(e) {
    e.stopPropagation();
}

function renderTimeline(eventsWithPositions) {
    $('#timeline-column').empty();
    eventsWithPositions.forEach(eventWithPosition => {
        const timelineDiv =
            `<div class="timeline-timestamp" style="grid-row: ${eventWithPosition.rowStartPosition} / ${eventWithPosition.rowStartPosition}">
                                &#x2022;${eventWithPosition.event.start}
                            </div>`;

        $('#timeline-column').append(timelineDiv);
    });
}