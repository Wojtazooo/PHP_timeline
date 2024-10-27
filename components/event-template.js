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

        clone.querySelector('.title').textContent = event.title;
        clone.querySelector('.start').textContent = `Start: ${event.start}`;
        clone.querySelector('.end').textContent = `End: ${event.end}`;
        clone.querySelector('.description').textContent = `Description: ${event.description}`;

        $('#events-column').append(eventDiv);
    });
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