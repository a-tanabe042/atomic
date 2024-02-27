import { useEffect } from 'react'
import { setPageTitle } from '../../features/common/headerSlice'
import Team from '../../features/settings/team'

function InternalPage(){
    useEffect(() => {
        setPageTitle({ title : "Team Members"})
    })

    return(
        <Team/>
    )
}

export default InternalPage