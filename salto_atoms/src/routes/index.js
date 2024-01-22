// All components mapping with path for internal routes

import { lazy } from 'react'


const Dashboard = lazy(() => import('../pages/protected/Dashboard'))
const Code = lazy(() => import('../pages/protected/Code'))
const Welcome = lazy(() => import('../pages/protected/Welcome'))
const Page404 = lazy(() => import('../pages/protected/404'))
const Blank = lazy(() => import('../pages/protected/Blank'))
const Charts = lazy(() => import('../pages/protected/Charts'))
const Teams = lazy(() => import('../pages/protected/Teams'))
const Projects = lazy(() => import('../pages/protected/Projects'))
const Calendar = lazy(() => import('../pages/protected/Calendar'))
const Team = lazy(() => import('../pages/protected/Team'))
const Members = lazy(() => import('../pages/protected/Members'))
const Bills = lazy(() => import('../pages/protected/Bills'))
const ProfileSettings = lazy(() => import('../pages/protected/ProfileSettings'))
const OrganizationChart  = lazy(() => import('../pages/protected/OrganizationChart'))
const GettingStarted = lazy(() => import('../pages/GettingStarted'))
const DocFeatures = lazy(() => import('../pages/DocFeatures'))
const DocComponents = lazy(() => import('../pages/DocComponents'))


const routes = [
  {
    path: '/dashboard', // the url
    component: Dashboard, // view rendered
  },
  {
    path: '/code', // the url
    component: Code, // view rendered
  },
  {
    path: '/welcome', // the url
    component: Welcome, // view rendered
  },
  {
    path: '/teams',
    component: Teams,
  },
  {
    path: '/settings-team',
    component: Team,
  },
  {
    path: '/settings-organization-chart',
    component: OrganizationChart,
  },
  {
    path: '/calendar',
    component: Calendar,
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
    path: '/settings-billing',
    component: Bills,
  },
  {
    path: '/getting-started',
    component: GettingStarted,
  },
  {
    path: '/features',
    component: DocFeatures,
  },
  {
    path: '/components',
    component: DocComponents,
  },
  {
    path: '/projects',
    component: Projects,
  },
  {
    path: '/charts',
    component: Charts,
  },
  {
    path: '/404',
    component: Page404,
  },
  {
    path: '/blank',
    component: Blank,
  },
]

export default routes
