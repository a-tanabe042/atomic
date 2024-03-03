import Welcome from '../pages/protected/Welcome';
import Page404 from '../pages/protected/404';
import Members from '../pages/protected/Members';
import Team from '../pages/protected/Team';
import ProfileSettings from '../pages/protected/ProfileSettings';
import GettingStarted from '../pages/GettingStarted';

const routes = [
  {
    path: '/welcome', // the url
    component: Welcome, // view rendered
  },
  {
    path: '/settings-team',
    component: Team,
  },
  {
    path: '/members',
    component: Members,
  },
  {
    path: '/settings-profile',
    component: ProfileSettings,
  },
  {
    path: '/getting-started',
    component: GettingStarted,
  },
  {
    path: '/404',
    component: Page404,
  },
]

export default routes
