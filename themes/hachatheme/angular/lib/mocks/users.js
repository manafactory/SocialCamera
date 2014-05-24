angular
  .module('app')
  .factory('users', function() {
    return [
      {
        name: 'Yehuda Katz',
        professione: 'Restauratore',
        email: 'katz@gotyourtongue.com',
        completed: 'completo',
        spent: '18.99',
        joined: new Date('January 1, 2014')
      },
      {
        name: 'DHH',
        professione: 'Restauratore',
        email: 'dhh@rails.net',
        completed: 'completo',
        spent: '0.00',
        joined: new Date('June 15, 2013')
      },
      {
        name: 'Avdi Grimm',
        professione: 'Restauratore',
        email: 'avdi@gmail.com',
        completed: '',
        spent: '10.99',
        joined: new Date('March 17, 2012')
      },
      {
        name: 'Ryan Bates',
        professione: 'Arrotino',
        email: 'ryan@railscasts.com',
        completed: '',
        spent: '200.00',
        joined: new Date('December 10, 2011')
      },
      {
        name: 'Sandi Metz',
        professione: 'Architetto',
        email: 'sandi@poodr.com',
        completed: 'completo',
        spent: '18.99',
        joined: new Date('May 11, 2010')
      }
    ];
  });
