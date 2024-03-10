import Welcome from '../pages/protected/Welcome';
import Page404 from '../pages/protected/404';
import MemberList from '../pages/protected/MemberList';
import Affiliation from '../pages/protected/Affiliation';
import ProfileSettings from '../pages/protected/ProfileSettings';

const routes = [
  {
    path: '/welcome', 
    component: Welcome, 
  },
  {
    path: '/member-list',
    component: MemberList,
  },
  {
    path: '/affiliation',
    component: Affiliation,
  },
  {
    path: '/settings-profile',
    component: ProfileSettings,
  },
  {
    path: '/404',
    component: Page404,
  },
]

export default routes
