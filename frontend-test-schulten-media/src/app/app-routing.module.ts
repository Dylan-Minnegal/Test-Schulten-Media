import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ProjectsListComponent } from './projects-list/projects-list.component';
import { LoginComponent } from './login/login.component';

const routes: Routes = [
  { path: 'projects', component: ProjectsListComponent},
  { path: 'login', component: LoginComponent },
  { path: '', redirectTo: '/projects', pathMatch: 'full' }, 
];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
