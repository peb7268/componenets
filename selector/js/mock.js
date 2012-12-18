//Config object for mock login
var CONFIG = function(module){
	module = {
		user: 
			{
				'username': '', //CONFIG.user.username
				'password': '',
				'role':'',
				'status': ''
			},
		roles: {
			0: 'root', //CONFIG.roles[0]
			1: 'admin',
			2: 'manager',
			3: 'user'
		},
		orgs: {
			0: 'Org1', //CONFIG.orgs[0]
			1: 'Org2',
			2: 'Org3',
			3: 'Org4'
		},
		countries:{
				0:'Britain',
				1:'USA',
				2:'France',
				3:'China',
				4:'back'
			},
		branches:{
				0: '#survery1',
				1: '#survery2',
				2: '#survery3',
				3: '#survery4',
				4: 'back'

		}
	}	
	return module;
}(CONFIG || {});