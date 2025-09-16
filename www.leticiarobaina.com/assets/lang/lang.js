var _multilanguageTool = new multilanguageToolClass();

function multilanguageToolClass()
{
	var self = this;
	var data = [];
	
	this.t = function(key, vars)
	{
		var line = '{' + key + '}';

		if(data.length == 0)
			return;
		
		if(data[key] !== undefined)
		{
			line = data[key];
			
			if(typeof(vars) == 'object')
			{
				for(var j in vars)
				{
					line = line.replace('%' + j.toUpperCase() + '%', vars[j]);
				}
			}
		}
		
		return line;
	}
	
	this.setData = function(d)
	{
		data = d;
	}
}