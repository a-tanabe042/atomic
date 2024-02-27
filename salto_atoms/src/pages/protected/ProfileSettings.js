import { useEffect } from 'react'
import { setPageTitle } from '../../features/common/headerSlice'
import ProfileSettings from '../../features/settings/profilesettings'

function InternalPage(){
    useEffect(() => {
        setPageTitle({ title : "Settings"})
      }, [])
    return(
        <ProfileSettings />
    )
}

export default InternalPage