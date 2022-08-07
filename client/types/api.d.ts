
export interface MetApiResponse {
  benchmark: number
  status: 'success' | 'failure'
  query: {
    options: Record<string, any>
    params: Record<string, any>
  }
  paginate?: {
    current_page: number
    first_item: number
    last_item: number
    last_page: number
    pages: Array<number>
    per_page: number
    total: number
  }
  data: any
}

export interface User {
  name: string
  job: string
  email: string
  phone: string
  avatar: string
}

export interface Skill {
  id : number,
  label : string,
  level : number,
  user_id : number
}

export interface Work {
  id : number,
  job_title : string,
  employer  : string,
  city      : string,
  start_date: string,
  end_date  : string
}

export interface Info{
  user_id : number,
  professional_summary : string,
  city: string,
  zip : string,
  phone : string
}

export type Users = Array<User>
