<?php
Class JS_GET_CALENDAR {
    private array $calendar_name_url;
    private string $calendar_id;
    private string $calender_iframe_id;
    private string $calender_start_url;
    
    public function __construct(array $calendar_name_url, string $calendar_id, string $calender_iframe_id, string $calender_start_url) {
        $this->calendar_name_url = $calendar_name_url;
        $this->calendar_id = $calendar_id;
        $this->calender_iframe_id = $calender_iframe_id;
        $this->calender_start_url = $calender_start_url;
    }

    // $calendar_name_url doit être un tableau comme ça : ['Salle' => 'url']
    public function getCalendarJS(): string {
    $js_array = json_encode($this->calendar_name_url); // tableau PHP vers JS

    return "
    document.addEventListener('DOMContentLoaded', function() {
            const calendarMap = {$js_array};
            const calendarSelect = document.getElementById('{$this->calendar_id}');
            const calendarIframe = document.getElementById('{$this->calender_iframe_id}');
            
            const calendarStartUrl = '{$this->calender_start_url}';
            if (calendarIframe == null){
                console.log('Pas de zone de calendrier à afficher');
            }else {
            calendarIframe.style.display = 'none';

            calendarSelect.addEventListener('change', function() {
                const selectedSalle = this.value;
                const calendarUrl = calendarMap[selectedSalle];
                if (calendarUrl) {
                    calendarIframe.src = calendarStartUrl + calendarUrl;
                    console.log('Calendrier affiché :', selectedSalle);
                    calendarIframe.style.display = 'block';
                } else {
                    calendarIframe.src = '';
                    calendarIframe.style.display = 'none';
                    console.warn('Aucun calendrier trouvé pour la salle sélectionnée.');
                }
            });
            }
        });
    ";
}

}

?>