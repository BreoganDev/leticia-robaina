function EventsClass()
{
	let events = [];
	
	this.on = function(event, callback) {
		if(events[event] == undefined)
			events[event] = [];
		
		events[event].push(callback);
	};

	this.off = function(event) {
		events[event] = undefined;
	}
	
	this.fire = function(event, params) {
		if(events[event])
		{
			for(var i in events[event])
			{
				var callback = events[event][i];
				
				if(typeof(callback) == 'function')
					callback(params);
			}
		}
	};

	this.all = function() {
		return events;
	}
}

_APP.events = new EventsClass();